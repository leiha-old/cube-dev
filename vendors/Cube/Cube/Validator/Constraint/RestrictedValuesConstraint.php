<?php

namespace Cube\Validator\Constraint;

class RestrictedValuesConstraint
    extends ConstraintWrapper
{
    /**
     * @var string[]
     */
    private $allowedValues = array();

    /**
     * @param string $value1
     * @return RestrictedValuesConstraint
     */
    public function addAllowedValues($value1 /* , value2, value2, .etc.. */)
    {
        return $this->addAllowedValuesByArray(func_get_args());
    }

    /**
     * @param array $values
     * @return $this
     */
    public function addAllowedValuesByArray(array $values)
    {
        $this->allowedValues = array_merge($this->allowedValues, $values);
        return $this;
    }

    /**
     * @param $value
     * @return bool
     */
    protected function is(&$value)
    {
        return in_array($value, $this->allowedValues);
    }


}