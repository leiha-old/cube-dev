<?php

namespace Cube\Poo\Mapper;

trait MapperFacade
{
    /**
     * @var static
     */
    private static $_single;

    /**
     */
    private $_configurator;

    /**
     * @return $this
     */
    public function ____construct()
    {
        $this->_configurator = Mapper::getConfiguratorTo(get_called_class(), $this);
        return $this;
    }

    /**
     * @param MapperConfigurator $configurator
     * @return mixed
     */
    abstract public function ____configureBehavior(MapperConfigurator $configurator);

    /**
     * @return static
     */
    public static function single()
    {
        if(!static::$_single) {
            static::$_single = Mapper::singleTo(get_called_class(), func_get_args());
        }
        return static::$_single;
    }

    /**
     * @return $this
     */
    public static function instance()
    {
        return Mapper::instanceTo(get_called_class(), func_get_args());
    }
}