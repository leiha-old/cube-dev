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
    use WrapperHelper;
    use InstanceHelper {
        instance   as private;
        instanceTo as private;
    }

    /**
     * @param object|string $wrapped
     * @param array  $args
     */
    public function __constructWrapper($wrapped, array $args = array())
    {
        if(is_object($wrapped)) {
            $this->wrappedObject    = $wrapped;
        } else {
            $this->wrappedArgs      = $args;
            $this->wrappedClassName = $wrapped;
        }
    }
}