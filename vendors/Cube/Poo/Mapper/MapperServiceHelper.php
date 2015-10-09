<?php
/**
 * Class MapperServiceHelper
 * @author Leiha Sellier <leiha.sellier@gmail.com>
 * @link   https://github.com/leiha
 * -
 */

namespace Cube\Poo\Mapper;

use Cube\Collection\Collection;
use Cube\Poo\Mapper\Mappable\MappableBehavior;
use Cube\Poo\Mapper\Mappable\MappableHelper;
use Cube\Poo\Reflection\Reflection;

trait MapperServiceHelper
{
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


	public function __construct()
	{
		if(!self::$_configurators){
			self::$_treeClasses = Collection::instance();
			self::$_reflectors  = Collection::instance();
			self::$_singles     = Collection::instance();
		}
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