<?php
/**
 * Created by PhpStorm.
 * User: lia
 * Date: 14/10/15
 * Time: 21:52
 */

namespace Cube\Poo\Wrapper;

use Cube\Poo\Instance\InstanceHelper;

abstract class Wrapper
    implements WrapperBehavior
{
    use InstanceHelper {
        instance   as private;
        instanceTo as private;
    }

    /**
     * @var string
     */
    private $wrappedClassName;

    /**
     * @var array
     */
    private $wrappedArgs = array();

    /**
     * @var mixed
     */
    private $wrappedObject;

    /**
     * @param object|string $wrapped
     * @param array  $args
     */
    public function __construct($wrapped, array $args = array())
    {
        if(is_object($wrapped)) {
            $this->wrappedObject    = $wrapped;
        } else {
            $this->wrappedArgs      = $args;
            $this->wrappedClassName = $wrapped;
        }
    }

    /**
     * @return mixed
     */
    public function getWrapped()
    {
        if(!$this->wrappedObject) {
            $this->wrappedObject = $this->instanceTo($this->wrappedClassName, $this->wrappedArgs);
        }

        return $this->wrappedObject;
    }
}