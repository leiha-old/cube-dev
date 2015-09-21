<?php

namespace Cube;

use Cube\Collection\Collection;
use Cube\Collection\CollectionBehavior;
use Cube\Poo\Mapper\MapperConfigurator;
use Cube\Poo\Mapper\MapperFacade;

class CubeConfigurator
{
    use MapperFacade;
    use CollectionBehavior {
        __construct as protected ____constructCollection;
    }

    /**
     * @param MapperConfigurator $configurator
     * @return mixed
     */
    public function ____configureBehavior(MapperConfigurator $configurator)
    {
        // TODO: Implement ____configureBehavior() method.
    }

    /**
     */
    public function __construct()
    {
        $this->____constructCollection(array(
            'mapping' => array()
        ));
    }

    /**
     * @param string $mapName MAPPING_*
     * @param bool $silent
     * @return string
     */
    public function getMapping($mapName, $silent = false)
    {
        return $this->getRail(['mapping', $mapName], $silent);
    }

    /**
     * @param string $mapName MAPPING_*
     * @param bool $force
     * @return string
     */
    public function addMapping($mapName, $className, $force = true)
    {
        return $this->setRail(['mapping', $mapName], $className, $force);
    }
}