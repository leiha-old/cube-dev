<?php

namespace Cube\Validator\Constraint;

interface ConstraintInterface
{
    /**
     * @param string   $value
     * @param \Closure $closure
     * @return mixed
     */
    public function run(&$value, \Closure $closure = null);
}