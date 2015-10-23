<?php

namespace Cube\Validator\Constraint;

interface ConstraintBehavior
{
    /**
     * @param string   $value
     * @param \Closure $closure
     * @return mixed
     */
    public function run(&$value, \Closure $closure = null);
}