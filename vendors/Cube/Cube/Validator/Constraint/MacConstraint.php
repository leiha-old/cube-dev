<?php

namespace Cube\Validator\Constraint;

use Cube\Validator\Tool\FilterVarHelper;

class MacConstraint
    extends ConstraintWrapper
{
    use FilterVarHelper;

    /**
     * @return int
     */
    protected function getType()
    {
        return FILTER_VALIDATE_MAC;
    }
}