<?php
/**
 * Class Mapper
 * @author Leiha Sellier <leiha.sellier@gmail.com>
 * @link   https://github.com/leiha
 * -
 */

namespace Cube\Poo\Mapper;

use Cube\Collection\Collection;
use Cube\Cube;
use Cube\FileSystem\AutoLoader\AutoLoader;
use Cube\Poo\Reflection\Reflection;
use Cube\Poo\Single\SingleTraitStatic;

class Mapper
    implements MapperConstants
{
    use SingleTraitStatic;


    /**
     * @var Collection
     */
    private static $_configurators;

    /**
     * @var Collection
     */
    private static $_reflectors;

    /**
     * @var Collection
     */
    private static $_singles;

    /**
     * @return Cube
     */
    public static function init() {
        self::$_configurators = new Collection();
        self::$_reflectors    = new Collection();
        self::$_singles       = new Collection();
        return Cube::instance();
    }

    /**
     * @param string $className
     * @param MapperFacade $targetInstance
     * @param bool   $silent
     * @return false|mixed
     */
    public static function getConfiguratorTo($className, MapperFacade $targetInstance = null, $silent = true) {
        /** @var MapperConfigurator $configurator */
        if($configurator = self::$_configurators->get($className, $silent)) {
            $configurator = self::instanceTo($configurator);
            if ($targetInstance) {
                $targetInstance->____configureBehavior($configurator);
            }
            return $configurator;
        }
        return false;
    }

    /**
     * @param string $className
     * @param string $configuratorClassName
     * @param bool   $silent
     * @return mixed|null
     */
    public static function setConfiguratorTo($className, $configuratorClassName, $silent = true) {

        if(class_exists($className)) {
            if(!class_exists($configuratorClassName, false)) {
                $configuratorClassName = Mapper::CONFIGURATOR_DEFAULT;
            }
            return self::$_configurators->set($className, $configuratorClassName, $silent);
        }
    }

    /**
     * @param string $className
     * @param array $args
     * @return static
     */
    public static function singleTo($className, array $args = array())
    {
        if(!$single = static::$_singles->get($className, true)) {
            $single = static::$_singles->set($className, Mapper::instanceTo($className, $args));
        }
        return $single;
    }

    /**
     * @param string $className
     * @param array  $args
     * @return object
     */
    public static function instanceTo($className, array $args = array())
    {
        // Retrieve Reflector
        if(!$reflector = self::$_reflectors->get($className, true)) {
            $reflector = self::$_reflectors->set($className, Reflection::reflectClass($className));

            // Retrieve Configurator
            if(!$configurator = self::getConfiguratorTo($className)) {
                $configurator = self::setConfiguratorTo($className, $className.'Configurator');
            }
        }

        $instance = $reflector->newInstanceWithoutConstructor();




//        if($reflector->hasMethod($method)) {
//            $instance->$method($options);
//        }

        // Call the real construct (__construct())
        if($reflector->hasMethod('__construct')) {
            call_user_func_array(array($instance, '__construct'), $args);
        }

        return $instance;
    }
}