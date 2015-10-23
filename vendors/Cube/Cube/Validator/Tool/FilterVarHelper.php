<?php

namespace Cube\Validator\Tool;

trait FilterVarHelper
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