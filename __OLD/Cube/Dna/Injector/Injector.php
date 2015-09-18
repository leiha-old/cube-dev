<?php
/**
 * Class Injector
 * @author Leiha Sellier <leiha.sellier@gmail.com>
 * @link   https://github.com/leiha
 * -
 */

namespace OLD\Cube\Dna\Injector;

use Cube\Collection\CollectionBehavior;
use Cube\Core\Instance\Single\SingleBehavior;
use Cube\Dna\Gene\GeneConfiguratorInterface;
use Cube\Dna\Gene\GeneBehavior;
use Cube\Dna\Injector\Behavior\InjectableConfigurator;

class Injector
    implements InjectorInterface
{
    use GeneBehavior;
    use SingleBehavior;

    use InjectorTrait;
    use CollectionBehavior {
        set as protected;
    }

    /**
     * Can be overridden
     * Used in LoaderTrait::loadWithLazy
     * @return \Closure ($className, InjectableConfigurator $configurator)
     */
    protected function ____getLazyCallBack()
    {
        return
            function ($className, InjectableConfigurator $configurator)
            {
                // @Todo : Make ME plz ! ;)
            };
    }

    /**
     * @param GeneConfiguratorInterface $configurator
     * @return mixed
     */
    public static function ____configureGene(GeneConfiguratorInterface $configurator)
    {
        // TODO: Implement ____configureGene() method.
    }
}