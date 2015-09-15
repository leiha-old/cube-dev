<?php
/**
 * Class Mapper
 * @author Leiha Sellier <leiha.sellier@gmail.com>
 * @link   https://github.com/leiha
 * -
 */

namespace Cube\Dna\Mapper;

use Cube\Collection\CollectionBehavior;
use Cube\Core\Instance\Single\SingleBehavior;
use Cube\Dna\Gene\GeneConfiguratorInterface;
use Cube\Dna\Gene\GeneBehavior;

class Mapper
    implements MapperInterface
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