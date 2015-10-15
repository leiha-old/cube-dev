<?php

namespace Cube\Validator\Tool;

use Cube\Validator\Constraint\ConstraintAbstract;

abstract class PregMatchAbstract
    extends ConstraintAbstract
{
    /**
     * @return int
     */
    abstract protected function getPattern();

    /**
     * @param string   $value
     * @return boolean|array
     */
    public function is(&$value)
    {
        $pattern = $this->getPattern();
        $is = preg_match($pattern, $value, $matches);
        return $is ? $matches : false;
    }
}