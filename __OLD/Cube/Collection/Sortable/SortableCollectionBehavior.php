<?php
/**
 * Class SortableCollectionBehavior
 * @author Leiha Sellier <leiha.sellier@gmail.com>
 * @link   https://github.com/leiha
 * -
 */

namespace OLD\Cube\Collection;

trait SortableCollectionBehavior
{
    use CollectionBehavior;

    /**
     * @param $flags
     * @param bool $return
     * @return $this
     */
    public function sortKeysByAsc($flags = Collection::SORT_REGULAR, $return = false)
    {
        return $this->_sortCollectionSortableBehavior('ksort', $flags, $return);
    }

    /**
     * @param $flags
     * @param bool $return
     * @return $this
     */
    public function sortKeysByDesc($flags = Collection::SORT_REGULAR, $return = false)
    {
        return $this->_sortCollectionSortableBehavior('krsort', $flags, $return);
    }

    /**
     * @param $flags
     * @param bool $return
     * @return $this
     */
    public function sortValuesByAsc($flags = Collection::SORT_REGULAR, $return = false)
    {
        return $this->_sortCollectionSortableBehavior('asort', $flags, $return);
    }

    /**
     * @param $flags
     * @param bool $return
     * @return $this
     */
    public function sortValuesByDesc($flags = Collection::SORT_REGULAR, $return = false)
    {
        return $this->_sortCollectionSortableBehavior('arsort', $flags, $return);
    }

    /**
     * @param string $func
     * @param int  $flags
     * @param bool $return
     * @return $this
     */
    private function _sortCollectionSortableBehavior($func, $flags, $return = false)
    {
        $items = $func($this->_items, $flags);

        if($return) {
            return $items;
        }

        $this->_items = $items;
        return $this;

    }
}