<?php

namespace Cube\Collection;

use Cube\Poo\Instance\InstanceTraitStatic;

class Collection
    implements CollectionConstants
{
    use InstanceTraitStatic;
    use CollectionBehavior;
}