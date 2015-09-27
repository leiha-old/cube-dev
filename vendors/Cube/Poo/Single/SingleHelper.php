<?php

namespace Cube\Poo\Single;

trait SingleHelper
{
	/**
	 * @var static
	 */
	private static $_single;

	/**
	 * @return static
	 */
	public static function single()
	{
		return self::singleTo(get_called_class(), func_get_args());
	}

    /**
     * @param string $className
     * @param array $args
     * @return static
     */
    public static function singleTo($className, array $args = array())
    {
        if(!static::$_single) {
            static::$_single = (new \ReflectionClass($className))
	            ->newInstanceArgs($args)
            ;
        }
        return static::$_single;
    }
}