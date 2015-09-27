<?php

namespace Cube;

use Cube\Collection\CollectionHelper;
use Cube\Poo\Mapper\Mappable\MappableBehavior;
use Cube\Poo\Mapper\Mappable\MappableHelper;

class CubeConfigurator
{
	/**
	 * @param MappableBehavior $configurator
	 * @return mixed
	 */
	public function ____configureBehavior(MappableBehavior $configurator)
	{
		// TODO: Implement ____configureBehavior() method.
	}

    use MappableHelper;
    use CollectionHelper {
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