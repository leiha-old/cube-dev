<?php
/**
 * Class ObserverBehaviorInterface
 * @author Leiha Sellier <leiha.sellier@gmail.com>
 * @link   https://github.com/leiha
 * -
 */

namespace OLD\Cube\Dna\Observer;

interface ObserverBehaviorInterface
{
    /**
     * @param ObserverConfigurator $configurator
     * @return mixed
     */
    public function ____configureObserver(ObserverConfigurator $configurator);

}