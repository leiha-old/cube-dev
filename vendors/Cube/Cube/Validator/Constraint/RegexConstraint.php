<?php

namespace Cube\Validator\Constraint;

use Cube\Validator\Tool\FilterVarHelper;

class RegExpConstraint
    extends ConstraintWrapper
{
    use FilterVarHelper;

    /**
     * @return int
     */
    protected function getType()
    {
        return FILTER_VALIDATE_REGEXP;
    }
}