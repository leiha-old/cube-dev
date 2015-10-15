<?php

namespace Cube\Validator\Tool;

use Cube\Validator\Constraint\ConstraintAbstract;
use Cube\Validator\Constraint\ConstraintOptions;

abstract class FilterVarAbstract
    extends ConstraintAbstract
{
    /**
     * @return int
     */
    abstract protected function getType();

    /**
     * @param $value
     * @return bool
     */
    protected function is(&$value)
    {
        return filter_var($value, $this->getType());
    }
}