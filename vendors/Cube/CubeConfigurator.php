<?php

namespace Cube;

use Cube\Collection\Collection;
use Cube\Collection\CollectionBehavior;
use Cube\Poo\Instance\InstanceTraitStatic;

class CubeConfigurator
{
    use InstanceTraitStatic;
    use CollectionBehavior {
        __construct as protected ____constructCollection;
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