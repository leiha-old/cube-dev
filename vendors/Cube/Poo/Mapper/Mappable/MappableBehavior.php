<?php

namespace Cube\Poo\Mapper\Mappable;

interface MappableBehavior
{
    /**
     * @return static
     */
    public static function single();

    /**
     * @return $this
     */
    public static function instance();

	/**
	 * @param MappableConfigurator $configurator
	 * @return mixed
	 */
	public function ____configureBehavior(MappableConfigurator $configurator);
}