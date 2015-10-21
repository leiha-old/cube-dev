<?php
/**
 * Class LoaderInterface
 * @author Leiha Sellier <leiha.sellier@gmail.com>
 * @link   https://github.com/leiha
 * -
 */

namespace OLD\Cube\Dna\Loader;


interface LoaderBehaviorInterface
{
    /**
     * @param LoaderConfigurator $configurator
     * @return mixed
     */
    public function ____configureLoader(LoaderConfigurator $configurator);
}