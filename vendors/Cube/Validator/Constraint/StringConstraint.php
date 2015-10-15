<?php

namespace Cube\Validator\Constraint;

class StringConstraint
    extends ConstraintAbstract
{
    /**
     * @param $value
     * @return bool
     */
    protected function is(&$value)
    {
        return is_string($value);
    }
}