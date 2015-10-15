<?php

namespace Cube\Validator\Constraint;

use Cube\Validator\Tool\FilterVarAbstract;

class FloatConstraint
    extends FilterVarAbstract
{
    /**
     * @return int
     */
    protected function getType()
    {
        return FILTER_VALIDATE_FLOAT;
    }
}