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

trait ValidatorHelper
{


    /**
     * @var Field[]
     */
    protected $fields = array();

    /**
     * @var Validator[]
     */
    protected $fieldSets = array();

    /**
     * @var array
     */
    protected $valuesValidated = array();

    /**
     * @var string
     */
    protected $name = '';

    /**
     * @param string $fieldSetName
     */
    public function __construct($fieldSetName)
    {
        $this->name = $fieldSetName;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param bool $includeGroups
     * @return array
     */
    public function getAllValues($includeGroups = true)
    {
        $values = $this->valuesValidated;

        if($includeGroups) {
            foreach($this->fieldSets as $fieldSet) {
                $values = array_merge($values, $fieldSet->getAllValues());
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
        return array_key_exists($groupName, $this->fieldSets)
            ? $this->fieldSets[$groupName]->validateValues($values, $errors)
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
         * Validate Fields of fieldSet
         */
        $cValidateFields = function()
        use ($values, &$errors)
        {
            foreach($this->fields as $fieldId => $field) {
                $fieldName = $field->getName();

                empty($values[$fieldName])
                    ? $this->fixEmptyValue($fieldId, $field, $errors)
                    : $this->validateValue($fieldId, $field, $values[$fieldName], $errors)
                ;
            }
        };

        /**
         * Validate Groups of fieldSet
         */
        $cValidateGroups = function()
        use ($values, &$errors, $includeGroups)
        {
            if ($includeGroups) {
                foreach ($this->fieldSets as $fieldSetName => $fieldSet) {
                    // If array values contains a key of fieldSet name and is an array
                    // Then we take this array for validation
                    $_values = isset($values[$fieldSetName]) && is_array($values[$fieldSetName])
                        ? $values[$fieldSetName]
                        : $values;

                    $fieldSet->validateValues($_values, $errors);
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
     * @param Field $field
     * @param array $errors
     */
    protected function fixEmptyValue($fieldId, Field $field, &$errors)
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
     * @param Field  $field
     * @param mixed  $value
     * @param array  $errors
     * @return bool
     */
    protected function validateValue($fieldId, Field $field, $value, &$errors)
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
        return $this->_add('fieldSet', $groupName);
    }

    /**
     * @param string $fieldName
     * @param mixed $defaultValue
     * @param string $type          Validator::*
     * @throws ConstraintError
     * @return Field
     */
    public function addField($fieldName, $defaultValue = null, $type = Validator::String)
    {
        return $this->_add('field', $fieldName)
            ->setType        ($type)
            ->addConstraint  ($type)
            ->setDefaultValue($defaultValue)
            ;
    }

    /**
     * @param string $groupName
     * @return Validator
     */
    public function getGroup($groupName)
    {
        return $this->_get('fieldSet', $groupName);
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
     * @param string $type [field | fieldSet]
     * @param string $name
     * @return Validator|Field
     */
    private function _add($type, $name)
    {
        $propName  = $type.'s';
        $className = constant('static::CLASS_'.$type);
        $this->{$propName}[$name] = new $className($name);
        return $this->{$propName}[$name];
    }

    /**
     * @param string $type [field | fieldSet]
     * @param string $name
     * @return Field
     */
    private function _get($type, $name)
    {
        $propName  = $type.'s';
        if(isset($this->{$propName}[$name])) {
            return $this->{$propName}[$name];
        }

        return null;
    }
}