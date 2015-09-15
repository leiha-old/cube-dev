<?php
/**
 * Class MultiSortableCollection
 * @author Leiha Sellier <leiha.sellier@gmail.com>
 * @link   https://github.com/leiha
 * -
 */

namespace Cube\Collection\MultiSortable;

use Cube\Collection\MultiSortableCollectionInterface;

class MultiSortableCollection
    implements MultiSortableCollectionInterface
{
    use MultiSortableCollectionBehavior;
}