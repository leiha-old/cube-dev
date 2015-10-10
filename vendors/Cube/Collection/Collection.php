<?php

namespace Cube\Collection;

use Cube\Poo\Instance\InstanceHelper;
use Cube\Poo\Mapper\Mappable\Mappable;

class Collection
    extends    Mappable
    implements CollectionConstants,
               \IteratorAggregate
{
	use InstanceHelper;
    use CollectionHelper;
}