<?php
/**
 * Class GeneConfiguratorInterface
 * @author Leiha Sellier <leiha.sellier@gmail.com>
 * @link   https://github.com/leiha
 * -
 */

namespace Cube\Dna\Gene;

interface GeneConfiguratorInterface
{
    /**
     * @param string $name
     * @return $this
     * @throws \Cube\Collection\CollectionException
     */
    public function setUniqueName($name);

    /**
     * @return string
     * @throws \Cube\Collection\CollectionException
     */
    public function getUniqueName();

    /**
     * @param string $mode Dna::GENE_*
     * @return $this
     * @throws \Cube\Collection\CollectionException
     */
    public function setGeneMode($mode = Gene::TYPE_SINGLE);

    /**
     * @return string
     * @throws \Cube\Collection\CollectionException
     */
    public function getGeneMode();
}