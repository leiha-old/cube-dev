<?php

namespace Cube\Validator\Constraint;

class StringConstraint
    extends ConstraintWrapper
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