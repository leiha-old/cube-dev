<?php
/**
 * Class GeneInterface
 * @author Leiha Sellier <leiha.sellier@gmail.com>
 * @link   https://github.com/leiha
 * -
 */

namespace OLD\Cube\Dna\Gene;

use Cube\Core\Configurator\Configurable\ConfigurableInterface;

interface GeneInterface
    extends ConfigurableInterface
{
    /**
     * @param GeneConfiguratorInterface $configurator
     * @return mixed
     */
    public static function ____configureGene(GeneConfiguratorInterface $configurator);
}