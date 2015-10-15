<?php

namespace Cube\Validator\Constraint;

use Cube\Validator\Tool\FilterVarAbstract;

class IpConstraint
    extends FilterVarAbstract
{
    /**
     * @return int
     */
    protected function getType()
    {
        return FILTER_VALIDATE_IP;
    }
}