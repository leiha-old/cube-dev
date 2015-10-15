<?php

namespace Cube;

use Cube\Collection\Collection;
use Cube\Poo\Mapper\Mappable\MappableHelper;

class CubeConfigurator
{
    use MappableHelper;

    /**
     * @var Collection
     */
    protected $settings = array();

	/**
     */
    public function __construct()
    {
        $this->settings = Collection::instance(array(
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
        return $this->settings->getRail(['mapping', $mapName], $silent);
    }

    /**
     * @param string $mapName MAPPING_*
     * @param bool $force
     * @return string
     */
    public function addMapping($mapName, $className, $force = true)
    {
        return $this->settings->setRail(['mapping', $mapName], $className, $force);
    }
}