<?php
/**
 * Class Dna
 * @author Leiha Sellier <leiha.sellier@gmail.com>
 * @link   https://github.com/leiha
 * -
 */

namespace Cube\Dna;

use Cube\Collection\Collection;
use Cube\Dna\Gene\GeneBehavior;

class Dna
{
    const GENE_TYPE_instance = 'instance';

    /**
     * @var Collection
     */
    private $genes;


    public function __construct() {
        $this->genes = Collection::instance();
    }

    /**
     * @param string $geneId
     * @param GeneBehavior $gene
     * @return $this
     */
    public function injectInstance($geneId, GeneBehavior $gene)
    {
        return $this->inject(self::GENE_TYPE_instance, $geneId, get_class($gene), $gene);
    }

    /**
     * @param \Closure $cbForEachItem ((&)$value, $key)
     * @return $this
     */
    public function iterateOnGene(\Closure $cbForEachItem)
    {
        return $this->genes->iterate($cbForEachItem);
    }

    /**
     * @param string $type
     * @param string $geneId
     * @param string $geneClass
     * @param GeneBehavior|\Closure $gene
     * @return $this
     */
    private function inject($type, $geneId, $geneClass, $gene)
    {
        $this->genes->set($geneId, compact('type', 'geneClass', 'gene'));
        return $this;
    }
}