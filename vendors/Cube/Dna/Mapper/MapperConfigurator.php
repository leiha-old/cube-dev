<?php
/**
 * Class MapperConfigurator
 * @author Leiha Sellier <leiha.sellier@gmail.com>
 * @link   https://github.com/leiha
 * -
 */

namespace Cube\Dna\Mapper;

use Cube\Collection\CollectionBehavior;

class MapperConfigurator
{
    use CollectionBehavior {
        set as private;
        get as private;
    }

    /**
     * @param $className
     */
    public function __construct($className)
    {
        $this->mapSingle($className);
    }

    /**
     * @param string $className
     * @param bool $force
     * @return MapperConfigurator
     */
    public function mapSingle($className, $force = true)
    {
        return $this->mapInstance('__single__', $className, $force);
    }

    /**
     * @param string $mapName
     * @param string $className
     * @param bool   $force
     * @return $this
     * @throws \Cube\Collection\CollectionException
     */
    public function mapInstance($mapName, $className, $force = false)
    {
        return $this->set($mapName, $className, $force);
    }

    /**
     * @return $this
     * @throws \Cube\Collection\CollectionException
     */
    public function getSingleClass()
    {
        return $this->get('__single__');
    }

    /**
     * @param string $mapName
     * @param bool   $silent
     * @return $this
     * @throws \Cube\Collection\CollectionException
     */
    public function getInstanceClass($mapName, $silent = false)
    {
        return $this->get($mapName, $silent);
    }
}