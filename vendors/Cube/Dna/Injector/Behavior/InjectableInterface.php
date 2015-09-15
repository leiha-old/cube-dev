<?php
/**
 * Class InjectableInterface
 * @author Leiha Sellier <leiha.sellier@gmail.com>
 * @link   https://github.com/leiha
 * -
 */

namespace Cube\Dna\Injector\Behavior;

interface InjectableBehavior
{
    /**
     * @param InjectableConfigurator $configurator
     * @return mixed
     */
    public function ____configureInjectable(InjectableConfigurator $configurator);
}