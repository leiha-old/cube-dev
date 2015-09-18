<?php

namespace Cube\Poo\Instance;

trait InstanceTraitStatic
{
    /**
     * @return $this
     */
    public static function instance()
    {
        return static::instanceTo(get_called_class(), func_get_args());
    }

    /**
     * @param string $className
     * @param array $args
     * @return object
     */
    public static function instanceTo($className, array $args = array())
    {
        $reflection = new \ReflectionClass($className);

        $instance = $reflection->newInstanceWithoutConstructor();
        if($args && $reflection->hasMethod('____init')) {
            call_user_func_array(array($instance, '____init'), $args);
        }

        return $instance;
    }
}