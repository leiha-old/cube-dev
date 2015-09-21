<?php

namespace Cube\Collection;

use Cube\Poo\Instance\InstanceTraitStatic;
use Traversable;

class Collection
    //extends \ArrayObject
    implements CollectionConstants,
               \IteratorAggregate
{
    use InstanceTraitStatic;
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
}