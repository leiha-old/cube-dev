<?php
/**
 * Class InstanceHelper
 * @author Leiha Sellier <leiha.sellier@gmail.com>
 * @link   https://github.com/leiha
 * -
 */

namespace Cube\Poo\Instance;

trait InstanceHelper
{
	/**
	 * @return string
	 */
	protected static function ____getClassOf()
	{
		return get_called_class();
	}

	/**
	 * @return static
	 */
	public static function instance()
	{
		return static::instanceTo(static::____getClassOf(), func_get_args());
	}

	/**
	 * @param string $className
	 * @param array $args
	 * @return object
	 */
	public static function instanceTo($className, array $args = array())
	{
		return (new \ReflectionClass($className))
			->newInstanceArgs($args)
			;
	}
}