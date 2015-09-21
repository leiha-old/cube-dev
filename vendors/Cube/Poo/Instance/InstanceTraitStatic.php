<?php

namespace Cube\Poo\Instance;

use Cube\CubeConfigurator;

trait InstanceTraitStatic
{
    private static $_instances     = array();

    private static $_configurators = array();

    private static $_methodsToCallFirst = array(
       '____construct' => array(),
    );

    /**
     * @param string $className
     * @return CubeConfigurator
     */
    public static function addConfigurator($className)
    {
        return static::$_configurators[$className] = CubeConfigurator::instance();
    }

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
        $instance   = $reflection->newInstanceWithoutConstructor();

        foreach(static::$_methodsToCallFirst as $method => $options) {
            if($reflection->hasMethod($method)) {
                $args = array();
                if(isset(static::$_configurators[$className])) {
                    $instance->$method(static::$_configurators[$className]);
                }
            }
        }

        if($reflection->hasMethod('__construct')) {
            call_user_func_array(array($instance, '__construct'), $args);
        }

        return $instance;
    }
}