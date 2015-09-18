<?php

namespace Cube\Poo\Single;

use Cube\Poo\Instance\InstanceTraitStatic;

trait SingleTraitStatic
{
    use InstanceTraitStatic {
        instance   as protected;
        instanceTo as protected;
    }

    /**
     * @var static
     */
    private static $_single;

    /**
     * @return static
     */
    public static function single()
    {
        return static::singleTo(get_called_class(), func_get_args());
    }

    /**
     * @param string $className
     * @param array $args
     * @param array $internalArgs
     * @return static
     */
    public static function singleTo($className, array $args = array(), array $internalArgs = array())
    {
        if(!static::$_single) {
            //static::$_single = new static();
            static::$_single = static::instanceTo($className, $args, $internalArgs);
        }
        return static::$_single;
    }
}