<?php
/**
 * Class ReflectionBehavior
 * @author Leiha Sellier <leiha.sellier@gmail.com>
 * @link   https://github.com/leiha
 * -
 */

namespace Cube\Dna\Biologist\Reflection;

interface ReflectionBehavior
{
    /**
     * @param $type
     * @return mixed
     */
    public static function reflect($type);

    /**
     * @param string|object $class
     * @return ReflectionClass
     */
    public static function reflectClass($class);

    /**
     * @param string|\Closure $function
     * @return ReflectionFunction
     */
    public static function reflectFunction($function);

    /**
     * @param string|\Object $classMethod
     * @param string $method
     * @return ReflectionMethod
     */
    public static function reflectMethod($classMethod, $method = '');
}