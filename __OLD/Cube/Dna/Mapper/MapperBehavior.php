<?php
/**
 * Class MapperBehavior
 * @author Leiha Sellier <leiha.sellier@gmail.com>
 * @link   https://github.com/leiha
 * -
 */

namespace OLD\Cube\Dna\Mapper;

use Cube\Core\Instance\Single\SingleBehavior;

trait MapperBehavior
{
    use SingleBehavior {
        single   as private _single;
        instance as private _instance;
    }

    /**
     * @var MapperConfigurator
     */
    private static $_MapperConfigurator;

    /**
     * @param $mapName
     * @return mixed
     * @throws \Cube\Collection\CollectionException
     */
    public static function instance($mapName)
    {
        return static::instanceTo(static::$_MapperConfigurator->instance($mapName));
    }

    /**
     * @return $this
     */
    public static function single()
    {
        return static::singleTo(static::$_MapperConfigurator->single(), func_get_args());
    }
}