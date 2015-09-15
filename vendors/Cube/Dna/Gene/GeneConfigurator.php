<?php
/**
 * Class GeneConfigurator
 * @author Leiha Sellier <leiha.sellier@gmail.com>
 * @link   https://github.com/leiha
 * -
 */

namespace Cube\Dna\Gene;

use Cube\Collection\CollectionBehavior;

class GeneConfigurator
    implements GeneConfiguratorInterface
{
    use CollectionBehavior {
        get as protected;
        set as protected;
        __construct as private __constructCollection;
    }

    public function __construct(){
        $this->__constructCollection(array(
            'name' => '',
            'type' => Gene::TYPE_SINGLE,
        ));
    }

    /**
     * @param string $name
     * @return $this
     * @throws \Cube\Collection\CollectionException
     */
    public function setUniqueName($name)
    {
        return $this->set('name', $name, true);
    }

    /**
     * @return string
     * @throws \Cube\Collection\CollectionException
     */
    public function getUniqueName()
    {
        return $this->get('name');
    }

    /**
     * @param string $mode Gene::TYPE_*
     * @return $this
     * @throws \Cube\Collection\CollectionException
     */
    public function setGeneMode($mode = Gene::TYPE_SINGLE)
    {
        return $this->set('type', $mode, true);
    }

    /**
     * @return string
     * @throws \Cube\Collection\CollectionException
     */
    public function getGeneMode(){
        return $this->get('type');
    }
}