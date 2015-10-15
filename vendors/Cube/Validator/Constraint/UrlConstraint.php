<?php

namespace Cube\Validator\Constraint;

use Cube\Validator\Tool\FilterVarAbstract;

class UrlConstraint
    extends FilterVarAbstract
{
    /**
     * @return int
     */
    protected function getType()
    {
        return FILTER_VALIDATE_URL;
    }
}