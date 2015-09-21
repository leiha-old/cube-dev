<?php

namespace Cube\Collection;

use Cube\Poo\Mapper\MapperConfigurator;
use Cube\Poo\Mapper\MapperFacade;
use Traversable;

class Collection
    //extends \ArrayObject
    implements CollectionConstants,
               \IteratorAggregate
{
    use MapperFacade;
    use CollectionBehavior;

    /**
     * Retrieve an external iterator
     * @link http://php.net/manual/en/iteratoraggregate.getiterator.php
     * @return Traversable An instance of an object implementing <b>Iterator</b> or
     * <b>Traversable</b>
     * @since 5.0.0
     */
    public function getIterator()
    {
        return $this->_items;
    }

    /**
     * @param MapperConfigurator $configurator
     * @return mixed
     */
    public function ____configureBehavior(MapperConfigurator $configurator)
    {
        // TODO: Implement ____configureBehavior() method.
    }
}