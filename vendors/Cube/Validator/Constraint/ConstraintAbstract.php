<?php

namespace Cube\Validator\Constraint;

abstract class ConstraintAbstract
    implements ConstraintInterface
{
    /**
     * @var \Closure ((&)$value, $matches)
     */
    private $cbOnSuccess;

    /**
     * @param $value
     * @return bool
     */
    abstract protected function is(&$value);

    /**
     * @param \Closure $cb
     * @return $this
     */
    public function setOnSuccess (\Closure $cb)
    {
        $this->cbOnSuccess = $cb;
        return $this;
    }

    /**
     * @param string $value
     * @param \Closure $closure ((&)$value, $is => can be another thing than boolean)
     * @return mixed
     */
    public function run(&$value, \Closure $closure = null)
    {
        if($closure) {
            $closure($this);
        }

        $is = $this->is($value);
        if($is && $this->cbOnSuccess) {
            $cb = $this->cbOnSuccess;
            $cb($value, $is /* can be another thing than boolean */);
            $is = true;
        }
        return $is;
    }
}