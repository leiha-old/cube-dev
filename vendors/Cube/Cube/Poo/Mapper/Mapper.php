<?php
/**
 * Class Mapper
 * @author Leiha Sellier <leiha.sellier@gmail.com>
 * @link   https://github.com/leiha
 * -
 */

namespace Cube\Poo\Mapper;

use Cube\Collection\Collection;
use Cube\Dna\Gene\GeneBehavior;
use Cube\Poo\Mapper\Mappable\MappableBehavior;
use Cube\Poo\Mapper\Mappable\MappableHelper;
use Cube\Poo\Reflection\Reflection;
use Cube\Poo\Single\SingleHelper;

class Mapper
    implements MapperConstants, GeneBehavior
{
	use SingleHelper;

    /**
     * @var Collection
     */
    private static $_treeClasses;

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


    public static function init()
    {
        if(!self::$_configurators){
            self::$_treeClasses = Collection::instance();
            self::$_reflectors  = Collection::instance();
            self::$_singles     = Collection::instance();
        }
        return self::single();
    }

    /**
     * @param array $items
     * @return $this
     */
    public function mapAll(array $items) {
        self::$_treeClasses->setAll($items);
        return $this;
    }

    /**
     * @param string $className
     * @param MappableHelper|MappableBehavior $targetInstance
     * @param bool   $silent
     * @return false|mixed
     */
    public static function getConfiguratorTo($className, MappableBehavior $targetInstance = null, $silent = true)
    {
        /** @var MappableBehavior $configurator */
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
    public static function setConfiguratorTo($className, $configuratorClassName, $silent = true)
    {
        if(class_exists($className)) {
            if(!class_exists($configuratorClassName, false)) {
                $configuratorClassName = Mapper::CONFIGURATOR_default;
            }
            return self::$_configurators->set($className, $configuratorClassName, true);
        }
    }

    /**
     * @param string $className1
     * @param string $className2
     * @return static
     */
    public static function map($className1, $className2) {
        self::$_treeClasses->setRail(array($className1, 'Class'), $className2);
        return self::single();
    }

    /**
     * @param string $className
     * @param array $args
     * @return static
     */
    public static function singleTo($className, array $args = array())
    {
        if(!$single = self::$_singles->get($className, true)) {
            $single = self::$_singles->set($className, static::instanceTo($className, $args));
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
        if(!$reflector = self::$_reflectors->get($className, true))
        {
            $className = self::$_treeClasses
                ->getRailOr(array($className, 'Class'), $className)
            ;

            $reflector = self::$_reflectors
                ->set($className, Reflection::reflectClass($className))
            ;
        }

        $instance = $reflector->newInstanceWithoutConstructor();
        if($reflector->hasMethod('____construct')) {
            $instance->____construct();
        }

        // Call the real construct (__construct())
        if($reflector->hasMethod('__construct')) {
            call_user_func_array(array($instance, '__construct'), $args);
        }

        return $instance;
    }
}