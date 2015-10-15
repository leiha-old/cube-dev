<?php

namespace Cube\Validator\Constraint;

use Cube\Validator\Tool\FilterVarAbstract;

class EmailConstraint
    extends FilterVarAbstract
{
    /**
     * @return int
     */
    protected function getType()
    {
        return FILTER_VALIDATE_EMAIL;
    }
}