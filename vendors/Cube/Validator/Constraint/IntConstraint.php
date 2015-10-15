<?php

namespace Cube\Validator\Constraint;

use Cube\Validator\Tool\FilterVarAbstract;

class IntConstraint
    extends FilterVarAbstract
{
    /**
     * @return int
     */
    protected function getType()
    {
        return FILTER_VALIDATE_INT;
    }
}