<?php

namespace Cube\Poo\Mapper\Mappable;

use Cube\Poo\Mapper\Mapper;
use Cube\Poo\Single\SingleHelper;

trait MappableHelper
{
	use SingleHelper;

	/**
	 * @return Mapper
	 */
	public static function mapper()
	{
		return Mapper::single();
 	}

	/**
	 * @return static
	 */
	public static function single()
	{
		return static::mapper()->singleTo(static::____getClassOf(), func_get_args());
	}

	/**
	 * @return static
	 */
	public static function instance()
	{
		return static::mapper()->instanceTo(static::____getClassOf(), func_get_args());
	}
}