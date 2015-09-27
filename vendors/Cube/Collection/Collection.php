<?php

namespace Cube\Collection;

use Cube\Poo\Instance\InstanceHelper;

class Collection
    //extends \ArrayObject
    implements CollectionConstants,
               \IteratorAggregate
{
	use InstanceHelper;
    use CollectionHelper;
}