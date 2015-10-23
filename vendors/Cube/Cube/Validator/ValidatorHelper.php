<?php
/**
 * Created by PhpStorm.
 * User: lia
 * Date: 22/10/15
 * Time: 16:43
 */

namespace Cube\Validator;

use Cube\Validator\Constraint\ConstraintError;
use Cube\Validator\Field\Field;
use Cube\Validator\Field\FieldBehavior;
use Cube\Validator\Type\Type;

trait ValidatorHelper
{
    /**
     * @var FieldBehavior[]
     */
    protected $fields = array();

    /**
     * @var ValidatorBehavior[]
     */
    protected $validators = array();

    /**
     * @var array
     */
    protected $valuesValidated = array();

    /**
     * @var string
     */
    protected $name = '';

    /**
     * @param string $validatorsName
     */
    public function __constructValidator($validatorsName)
    {
        if(!is_subclass_of($validatorsName, $this->getClassOfValidator()))
        {
            // @Todo : Make an Exception
        }
        $this->name = $validatorsName;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    abstract protected function getClassOfValidator();

    /**
     * @return string
     */
    abstract protected function getClassOfField();

    /**
     * @param bool $includeGroups
     * @return array
     */
    public function getAllValues($includeGroups = true)
    {
        $values = $this->valuesValidated;

        if($includeGroups) {
            foreach($this->validators as $validators) {
                $values = array_merge($values, $validators->getAllValues());
            }
        }

        return $values;
    }

    /**
     * @param string $groupName
     * @param array  $values
     * @param array  $errors
     * @return boolean
     */
    public function validateGroupValues($groupName, array $values, &$errors)
    {
        return array_key_exists($groupName, $this->validators)
            ? $this->validators[$groupName]->validateValues($values, $errors)
            : false
            ;
    }

    /**
     * @param array $values
     * @param array $errors
     * @param bool $includeGroups
     * @return bool
     */
    public function validateValues(array $values, &$errors, $includeGroups = true)
    {
        /**
         * Validate Fields of validators
         */
        $cValidateFields = function()
        use ($values, &$errors)
        {
            foreach($this->getFields() as $fieldId => $field) {
                $fieldName = $field->getName();

                empty($values[$fieldName])
                    ? $this->fixEmptyValue($fieldId, $field, $errors)
                    : $this->validateValue($fieldId, $field, $values[$fieldName], $errors)
                ;
            }
        };

        /**
         * Validate Groups of validators
         */
        $cValidateGroups = function()
        use ($values, &$errors, $includeGroups)
        {
            if ($includeGroups) {
                foreach ($this->validators as $validatorsName => $validators) {
                    // If array values contains a key of validators name and is an array
                    // Then we take this array for validation
                    $_values = isset($values[$validatorsName]) && is_array($values[$validatorsName])
                        ? $values[$validatorsName]
                        : $values;

                    $validators->validateValues($_values, $errors);
                }
            }
        };

        $this->valuesValidated = array();

        $cValidateFields();
        $cValidateGroups();

        return (count($errors) == 0);
    }

    /**
     * @param string $fieldId
     * @param FieldBehavior $field
     * @param array $errors
     */
    protected function fixEmptyValue($fieldId, FieldBehavior $field, &$errors)
    {
        if($field->isRequired()) {
            $errors[$field->getName()]['required'] = true;
            return;
        }

        $defaultValue = $field->getDefaultValue();
        if(null !== $defaultValue) {
            $this->valuesValidated[$fieldId] = $defaultValue;
        }
    }

    /**
     * @param string $fieldId
     * @param FieldBehavior  $field
     * @param mixed  $value
     * @param array  $errors
     * @return bool
     */
    protected function validateValue($fieldId, FieldBehavior $field, $value, &$errors)
    {
        $is = $field->validate($value, $errors);
        if($is) {
            $this->valuesValidated[$fieldId] = $value;
        }

        return array_key_exists($fieldId, $errors)
            ? (count($errors[$fieldId]) === 0)
            : true
            ;
    }

    /**
     * @param $groupName
     * @return Validator
     */
    public function addGroup($groupName)
    {
        return $this->_add('validators', $groupName);
    }

    /**
     * @param string $fieldName
     * @param mixed $defaultValue
     * @param string $type          Type::*
     * @throws ConstraintError
     * @return FieldBehavior
     */
    public function addField($fieldName, $defaultValue = null, $type = Type::String)
    {
        return $this->_add('field', $fieldName)
            ->setType        ($type)
            ->addConstraint  ($type)
            ->setDefaultValue($defaultValue)
            ;
    }

    /**
     * @param string $groupName
     * @return ValidatorBehavior
     */
    public function getGroup($groupName)
    {
        return $this->_get('validators', $groupName);
    }

    /**
     * @param string $fieldName
     * @return Field
     */
    public function getField($fieldName)
    {
        return $this->_get('field', $fieldName);
    }

    /**
     * @param string $type [field | validators]
     * @param string $name
     * @return ValidatorBehavior|FieldBehavior
     */
    private function _add($type, $name)
    {
        $propName  = $type.'s';
        $className = constant('static::CLASS_'.$type);
        $this->{$propName}[$name] = new $className($name);
        return $this->{$propName}[$name];
    }

    /**
     * @param string $type [field | validators]
     * @param string $name
     * @return FieldBehavior
     */
    private function _get($type, $name)
    {
        $propName  = $type.'s';
        if(isset($this->{$propName}[$name])) {
            return $this->{$propName}[$name];
        }

        return null;
    }

    /**
     * @return FieldBehavior[]
     */
    public function getFields()
    {
        return $this->fields;
    }
}