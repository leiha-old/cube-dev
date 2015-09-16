<?php
/**
 * Class ReflectionTrait
 * @author Leiha Sellier <leiha.sellier@gmail.com>
 * @link   https://github.com/leiha
 * -
 */

namespace Cube\Dna\Biologist\Reflection;

trait ReflectionTrait
{
    private static $_abilities = array(
        'class'    => '\Cube\Dna\Biologist\Reflection\ReflectionTrait::reflectClass',
        'function' => '\Cube\Dna\Biologist\Reflection\ReflectionTrait::reflectFunction',
        'method'   => '\Cube\Dna\Biologist\Reflection\ReflectionTrait::reflectMethod'
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
     * @return ReflectionClass
     * @throws ReflectionException
     */
    public static function reflectClass($class)
    {
        try {
            return new ReflectionClass($class);
        } catch(\Exception $e) {
            throw new ReflectionException($e->getMessage());
        }
    }

    /**
     * @param string|\Closure $function
     * @return ReflectionFunction
     * @throws ReflectionException
     */
    public static function reflectFunction($function)
    {
        try {
            return new ReflectionFunction($function);
        } catch(\Exception $e) {
            throw new ReflectionException($e->getMessage());
        }
    }

    /**
     * @param string|\Object $classMethod
     * @param string $method
     * @return ReflectionFunction
     * @throws ReflectionException
     */
    public static function reflectMethod($classMethod, $method = '')
    {
        try {
            if($method) {
                return new ReflectionMethod($classMethod, $method);
            } else {
                return new ReflectionMethod($classMethod);
            }
        } catch(\Exception $e) {
            throw new ReflectionException($e->getMessage());
        }
    }
}