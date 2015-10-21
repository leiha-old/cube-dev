<?php
/**
 * Class ReflectionTrait
 * @author Leiha Sellier <leiha.sellier@gmail.com>
 * @link   https://github.com/leiha
 * -
 */

namespace Cube\Poo\Reflection;

use Cube\Poo\Reflection\Closure\ClosureReflection;
use Cube\Poo\Reflection\Method\MethodReflection;

trait ReflectionStatic
{
    private static $_abilities = array(
        'class'    => '\Cube\Poo\Reflection\Reflection::reflectClass',
        'function' => '\Cube\Poo\Reflection\Reflection::reflectFunction',
        'method'   => '\Cube\Poo\Reflection\Reflection::reflectMethod'
    );

    /**
     * @param $type
     * @return mixed
     */
    public static function reflect($type)
    {
        $args = func_get_args();

        $classType = array_shift($args);
        if(!isset(static::$_abilities[$classType])) {
            // @Todo : Make an Exception
        }

        return call_user_func_array(static::$_abilities[$classType], $args);
    }

    /**
     * @param string|\Closure $class
     * @return Reflection
     * @throws ReflectionException
     */
    public static function reflectClass($class)
    {
        try {
            return new Reflection($class);
        } catch(\Exception $e) {
            throw new ReflectionException($e->getMessage());
        }
    }

    /**
     * @param string|\Closure $function
     * @return ClosureReflection
     * @throws ReflectionException
     */
    public static function reflectFunction($function)
    {
        try {
            return new ClosureReflection($function);
        } catch(\Exception $e) {
            throw new ReflectionException($e->getMessage());
        }
    }

    /**
     * @param string|\Object $classMethod
     * @param string $method
     * @return MethodReflection
     * @throws ReflectionException
     */
    public static function reflectMethod($classMethod, $method = '')
    {
        try {
            if( $method) {
                return new MethodReflection($classMethod, $method);
            } else {
                return new MethodReflection($classMethod);
            }
        } catch(\Exception $e) {
            throw new ReflectionException($e->getMessage());
        }
    }
}