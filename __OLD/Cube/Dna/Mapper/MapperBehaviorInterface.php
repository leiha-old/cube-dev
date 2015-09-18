<?php
/**
 * Class MapperBehaviorInterface
 * @author Leiha Sellier <leiha.sellier@gmail.com>
 * @link   https://github.com/leiha
 * -
 */

namespace OLD\Cube\Dna\Mapper;

interface MapperBehaviorInterface
{
    /**
     * @param MapperConfigurator $configurator
     * @return mixed
     */
    public function ____configureMapper(MapperConfigurator $configurator);
}