<?php
/**
 * Class Loader
 * @author Leiha Sellier <leiha.sellier@gmail.com>
 * @link   https://github.com/leiha
 * -
 */

namespace Cube\Dna\Loader;

use Cube\Collection\CollectionBehavior;
use Cube\Core\Instance\Single\SingleBehavior;
use Cube\Dna\Gene\GeneConfiguratorInterface;
use Cube\Dna\Gene\GeneBehavior;

class Loader
{
    use GeneBehavior;
    use SingleBehavior;
    use LoaderTrait;
    use CollectionBehavior {
        set as protected;
    }

    /**
     * Can be overridden
     * Used in LoaderTrait::loadWithLazy
     * @return \Closure ($className, LoaderConfigurator $configurator)
     */
    protected function ____getLazyCallBack()
    {
        return
            function ($className, LoaderConfigurator $configurator)
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