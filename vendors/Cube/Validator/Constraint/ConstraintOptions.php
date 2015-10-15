<?php
/**
 * Created by PhpStorm.
 * User: lia
 * Date: 24/09/15
 * Time: 15:44
 */

namespace Cube\Validator\Constraint;


class ConstraintOptions
{
    /**
     * @var \Closure
     */
    private $cbOnSuccess = null;


    public function onSuccess ()
    {
        if(!$this->cbOnSuccess) {
            return call_user_func_array($this->cbOnSuccess, func_get_args());
        }
    }

    /**
     * @param \Closure $cb
     * @return $this
     */
    public function setOnSuccess(\Closure $cb)
    {
        $this->cbOnSuccess = $cb;
        return $this;
    }
}