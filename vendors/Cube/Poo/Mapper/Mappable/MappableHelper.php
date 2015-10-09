<?php

namespace Cube\Poo\Mapper\Mappable;

use Cube\Poo\Mapper\Mapper;
use Cube\Poo\Mapper\MapperService;
use Cube\Poo\Single\SingleHelper;

trait MappableHelper
{
	use SingleHelper;

    /**
     */
    private $configurator;

    /**
     * @return $this
     */
    public function ____construct()
    {
        //$this->configurator = self::mapper()->getConfiguratorTo(get_called_class(), $this);
        return $this;
    }

	/**
	 * @return MapperService
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
		return self::mapper()->singleTo(get_called_class(), func_get_args());
	}

	/**
	 * @return static
	 */
	public static function instance()
	{
		return self::mapper()->instanceTo(get_called_class(), func_get_args());
	}
}