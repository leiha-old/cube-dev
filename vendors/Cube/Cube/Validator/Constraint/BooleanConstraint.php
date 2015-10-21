<?php

namespace Cube\Validator\Constraint;

class BooleanConstraint
    extends ConstraintAbstract
{
    /**
     * @param $value
     * @return bool
     */
    public function is(&$value)
    {
        return is_bool($value);
    }
}