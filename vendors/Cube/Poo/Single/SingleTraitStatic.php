<?php

namespace Cube\Poo\Single;

use Cube\Poo\Mapper\MapperFacade;

trait SingleTraitStatic
{
//    use MapperFacade {
//        instance   as protected;
//        instanceTo as protected;
//    }

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
     * @return static
     */
    public static function singleTo($className, array $args = array())
    {
        if(!static::$_single) {
            //static::$_single = new static();
            static::$_single = static::instanceTo($className, $args);
        }
        return static::$_single;
    }
}