<?php
/**
 * Created by PhpStorm.
 * User: lia
 * Date: 22/10/15
 * Time: 23:21
 */

namespace Cube\Validator\Field;

use Cube\Validator\Cleaner\Cleaner;
use Cube\Validator\Cleaner\CleanerError;
use Cube\Validator\Constraint\Constraint;
use Cube\Validator\Constraint\ConstraintError;
use Cube\Validator\Constraint\RestrictedValuesConstraint;
use Cube\Validator\Test\Type;
use Cube\Validator\Validator;

trait FieldHelper
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
    private $type = Type::String;

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
     * @var Validator
     */
    private $parentValidator;

    /**
     * @var string
     */
    private $defaultValue;

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
     * @throws ConstraintError
     * @throws CleanerError
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
     * @throws ConstraintError
     * @return $this
     */
    public function addAllowedValues($value1 /* , value2, value2, .etc.. */)
    {
        $allowedValues = func_get_args();
        return $this->addConstraint  (
            Field::CONSTRAINT_restricted,
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
     * @throws \Cube\Validator\Constraint\ConstraintError
     */
    public function addConstraint($constraintName = Field::CONSTRAINT_string, \closure $cb = null)
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
     * @throws CleanerError
     * @return $this
     */
    public function addCleaner($cleanerName = Field::CLEANER_string, array $options = array())
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
    public function setType($type = Field::TYPE_string)
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