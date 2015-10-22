<?php

namespace Cube\Validator\FieldSet\Field;

use Cube\Validator\Cleaner\Cleaner;
use Cube\Validator\Cleaner\CleanerConstants;
use Cube\Validator\Cleaner\CleanerException;
use Cube\Validator\Constraint\Constraint;
use Cube\Validator\Constraint\ConstraintConstants;
use Cube\Validator\Constraint\ConstraintException;
use Cube\Validator\Constraint\RestrictedValuesConstraint;
use Cube\Validator\FieldSet\FieldSet;

class Field
    implements FieldConstants,
               ConstraintConstants,
               CleanerConstants,
               FieldInterface
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $alias;

    /**
     * @var string
     */
    private $type = self::TYPE_string;

    /**
     * @var bool
     */
    private $required = false;

    /**
     * @var array
     */
    private $constraints = array();

    /**
     * @var array
     */
    private $cleaners = array();

    /**
     * @var FieldSet
     */
    private $parentFieldSet;

    /**
     * @var string
     */
    private $defaultValue;

    /**
     * @param string   $fieldName
     * @param FieldSet $parentFieldSet
     */
    public function __construct($fieldName, FieldSet $parentFieldSet = null)
    {
        $this->name           = $fieldName;
        $this->parentFieldSet = $parentFieldSet;
    }

    /**
     * @param mixed $value
     * @return $this
     */
    public function setDefaultValue($value)
    {
        $this->defaultValue = $value;
        return $this;
    }

    /**
     * @param mixed $value
     * @param array $errors
     * @throws ConstraintException
     * @throws CleanerException
     * @return boolean
     */
    public function validate(&$value, &$errors)
    {
        Cleaner::run($this->cleaners, $value);

        if($errs = Constraint::run($this->constraints, $value)) {
            $errors[$this->name] = $errs;
        }

        return !array_key_exists($this->name, $errors);
    }

    /**
     * @param string $value1
     * @throws ConstraintException
     * @return $this
     */
    public function addAllowedValues($value1 /* , value2, value2, .etc.. */)
    {
        $allowedValues = func_get_args();
        return $this->addConstraint  (
            self::CONSTRAINT_restricted,
            function(RestrictedValuesConstraint $constraint)
                use ($allowedValues)
            {
                $constraint->addAllowedValuesByArray($allowedValues);
            }
        );
    }

    /**
     * @param string $constraintName
     * @param \closure|null $cb
     * @return $this|false
     * @throws \Cube\Validator\Constraint\ConstraintException
     */
    public function addConstraint($constraintName = self::CONSTRAINT_string, \closure $cb = null)
    {
        //$c = new \ReflectionFunction($cb);


        if($is = Constraint::has($constraintName)) {
            /** @noinspection OffsetOperationsInspection */
            $this->constraints[$constraintName] = $cb;
            return $this;
        }
        return $is;
    }

    /**
     * @param string $cleanerName (Field | Validator)::CLEANER_*
     * @param array  $options
     * @throws CleanerException
     * @return $this
     */
    public function addCleaner($cleanerName = self::CLEANER_string, array $options = array())
    {
        if($is = Cleaner::has($cleanerName)) {
            $this->cleaners[$cleanerName] = $options;
            return $this;
        }
        return $is;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type (Field | Validator)::TYPE_*
     * @return $this
     */
    public function setType($type = self::TYPE_string)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @param string $alias
     * @return $this
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;
        return $this;
    }

    /**
     * @param bool $enable
     * @return $this
     */
    public function enableRequired($enable = true)
    {
        $this->required = (bool)$enable;
        return $this;
    }

    /**
     * @return bool
     */
    public function isRequired()
    {
        return $this->required;
    }

    /**
     * @return string
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * @param bool $forceRealName
     * @return string
     */
    public function getName($forceRealName = false)
    {
        return !$forceRealName && $this->alias
            ? $this->alias
            : $this->name
            ;
    }

    /**
     * @return string
     */
    public function getDefaultValue()
    {
        return $this->defaultValue;
    }
}