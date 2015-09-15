<?php
/**
 * Class Observer
 * @author Leiha Sellier <leiha.sellier@gmail.com>
 * @link   https://github.com/leiha
 * -
 */

namespace Cube\Dna\Observer;

use Cube\Collection\CollectionBehavior;
use Cube\Core\Instance\Single\SingleBehavior;
use Cube\Dna\Gene\GeneConfiguratorInterface;
use Cube\Dna\Gene\GeneBehavior;

class Observer
    implements ObserverInterface
{
    use GeneBehavior;
    use SingleBehavior;
    use CollectionBehavior {
        set as public register;
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