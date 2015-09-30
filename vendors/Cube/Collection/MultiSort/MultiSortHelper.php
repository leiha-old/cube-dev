<?php
/**
 * Class MultiSortHelper
 * @author Leiha Sellier <leiha.sellier@gmail.com>
 * @link   https://github.com/leiha
 * @link   http://php.net/manual/fr/function.array-multisort.php
 * -
 */

namespace Cube\Collection\MultiSortCollectionHelper;

use Cube\Collection\Collection;
use Cube\Collection\CollectionHelper;

trait MultiSortHelper
{
    use CollectionHelper;

    /**
     * @var array
     */
    private $_columns = array();

    /**
     * @param mixed $column
     * @param int   $flags
     * @param bool  $return
     * @return $this
     */
    public function sortByAsc($column, $flags = Collection::SORT_regular, $return = false)
    {
        return $this->_sortCollectionMultiSortBehavior(SORT_ASC, $column, $flags, $return);
    }

    /**
     * @param mixed $column
     * @param int   $flags
     * @param bool  $return
     * @return $this
     */
    public function sortByDesc($column, $flags = Collection::SORT_regular, $return = false)
    {
        return $this->_sortCollectionMultiSortBehavior(SORT_DESC, $column, $flags, $return);
    }

    /**
     * @param int   $order
     * @param mixed $column
     * @param int   $flags
     * @param bool  $return
     * @return $this
     */
    private function _sortCollectionMultiSortBehavior($order, $column, $flags, $return)
    {
        $this->_columns[$column] = array($order, $flags);
        return $this;
    }

    /**
     * @param bool $return
     * @return $this|array
     */
    public function run ($return = false) {
        $items = $this->_items;

        $args = array();
        foreach ($this->_columns as $column => $options) {
            $array = array();
            foreach ($items[$column] as $value) {
                $array[] = $value;
            }
            $args[] = $array;
            $args[] = $options[0];
            $args[] = $options[1];
        }
        $args[] = &$items;

        call_user_func_array('array_multisort', $args);

        if($return) {
            return $items;
        }
        $this->_items = $items;
        return $this;
    }
}