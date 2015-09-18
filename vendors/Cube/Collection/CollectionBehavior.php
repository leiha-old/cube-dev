<?php
/**
 * Class CollectionBehavior
 * @author Leiha Sellier <leiha.sellier@gmail.com>
 * @link   https://github.com/leiha
 * -
 */

namespace Cube\Collection;

trait CollectionBehavior
{
    use CollectionBehaviorStatic;

    /**
     * @var array
     */
    protected $_items;

    /**
     * @param array $items
     * @return $this
     */
    public function ____init(array $items = array()) {
        $this->_items = $items;
        return $this;
    }

    /**
     * @return array
     */
    public function getAll() {
        return $this->_items;
    }

    /**
     * @return bool
     */
    public function isEmpty() {
        return count($this->_items) == 0;
    }

    /**
     * @param int $flags
     * @return $this
     */
    public function sort($flags = Collection::SORT_REGULAR)
    {
        $this->_items = sort($this->_items, $flags);
        return $this;
    }

    /**
     * @param string $itemKey
     * @param bool $silent
     * @return mixed|null
     * @throws CollectionException
     */
    public function &get($itemKey, $silent = false)
    {
        $is = isset($this->_items[$itemKey]);
        if(!$is) {
            $this->exception(
                CollectionException::ITEM_404,
                compact('itemKey'),
                $silent
            );
        }

        $ret = &$this->_items[$itemKey];
        return $ret;
    }

    /**
     * @param string|array $rail
     * @param bool $silent
     * @return mixed Return item found at the end of rail (you can add & for reference)
     * @throws CollectionException
     */
    public function &getRail($rail, $silent = true)
    {
        $ret = &$this->iterateOnRail($rail,
            function ($exist, $isEnd, &$item, $key, $railProgression)
                use ($silent)
            {
                if (!$exist) {
                    $this->exception(
                        CollectionException::RAIL_404,
                        compact('railProgression'),
                        $silent
                    );
                }
                else if ($isEnd) {
                    return $item;
                }
            }
        );
        return $ret;
    }

    /**
     * @param string $itemKey
     * @param mixed $value
     * @param bool $force
     * @return $this
     * @throws CollectionException
     */
    public function set($itemKey, $value, $force = false)
    {
        if(!$force && isset($this->_items[$itemKey]))
        {
            $this->exception(
                CollectionException::ITEM_DUPLICATE,
                compact('itemKey'),
                $force
            );
        }
        $this->_items[$itemKey] = $value;
        return $this;
    }

    /**
     * @param string|array $rail
     * @param mixed $value
     * @param bool $force
     * @return mixed Return item found at the end of rail (you can add & for reference)
     * @throws CollectionException
     */
    public function &setRail($rail, &$value, $force = true)
    {
        $ret = &$this->iterateOnRail($rail,
            function ($exist, $isEnd, &$item, $key, $railProgression)
                use ($force, &$value)
            {
                if (!$exist) {
                    $this->exception(
                        CollectionException::RAIL_404,
                        compact('railProgression'),
                        $force
                    );

                    $item[$key] = array();
                    if ($isEnd) {
                        $item[$key] = &$value;
                    }
                } else {
                    $this->exception(
                        CollectionException::RAIL_DUPLICATE,
                        compact('railProgression'),
                        $force
                    );

                    if ($isEnd) {
                        $item = &$value;
                    }
                }
            }
        );
        return $ret;
    }

    /**
     * @param \Closure $cbForEachItem ((&)$value, $key)
     * @param bool $reverseMode
     * @return $this
     */
    public function iterate(\Closure $cbForEachItem, $reverseMode = false)
    {
        Collection::iterateArray($this->_items, $cbForEachItem, $reverseMode);
        return $this;
    }

    /**
     * @param string $itemKey
     * @param \Closure $cbForEachItem ((&)$item, $key)
     * @param bool $silent
     * @param bool $reverseMode
     * @return $this
     */
    public function iterateItem(
        $itemKey, \Closure $cbForEachItem, $silent = true, $reverseMode = false
    ) {
        if($array = &$this->get($itemKey, $silent)) {
            $this->iterateArray($array, $cbForEachItem, $reverseMode);
        }
        return $this;
    }

    /**
     * @param array $rail Array with the tree of itemKeys
     * @param \Closure $cbForEachItem ($exist, $isEnd, &$item, $absoluteKey, $key)
     * @param bool $silent
     * @param bool $reverseMode
     * @return $this
     */
    public function iterateRail(
        $rail, \Closure $cbForEachItem, $silent = false, $reverseMode = false
    ) {
        if($array = &$this->getRail($rail, $silent)) {
            $this->iterateArray($array, $cbForEachItem, $reverseMode);
        }
        return $this;
    }

    /**
     * @param array $rail Array with the tree of itemKeys
     * @param \Closure $cbForEachItem ($exist, $isEnd, (&)$item, $key, $railProgression)
     * @return mixed Return item found at the end of rail (you can add & for reference)
     */
    public function &iterateOnRail(array $rail, \Closure $cbForEachItem)
    {
        return $this->iterateArrayOnRail($this->_items, $rail, $cbForEachItem);
    }

    /**
     * @param \Closure $cbForEachItem ((&)$value, $key, $counter, $total)
     * @param bool $reverseMode
     * @return $this
     */
    public function iterateWithCounter(\Closure $cbForEachItem, $reverseMode = false)
    {
        $this->iterateArrayWithCounter($this->_items, $cbForEachItem, $reverseMode);
        return $this;
    }

    /**
     * @link http://php.net/manual/fr/function.array-merge.php
     * @link http://php.net/manual/fr/function.array-merge-recursive.php
     * @param array $items
     * @param bool $recursive
     * @return $this
     *
     */
    public function mergeWith(array $items, $recursive = false)
    {
        $f = 'array_merge'.$recursive ? '_recursive' : '';
        $this->_items = $f($this->_items, $items);
        return $this;
    }

    /**
     * @link http://php.net/manual/fr/function.array-replace.php
     * @link http://php.net/manual/fr/function.array-replace-recursive.php
     * @param array $items
     * @param bool $recursive
     * @return $this
     *
     */
    public function replaceWith(array $items, $recursive = false)
    {
        $f = 'array_replace'.$recursive ? '_recursive' : '';
        $this->_items = $f($this->_items, $items);
        return $this;
    }

    /**
     * @param \Closure $callback ((&)$value)
     * @return array
     */
    public function filter(\Closure $callback)
    {
        return array_filter($this->_items, $callback/* , ARRAY_FILTER_USE_BOTH >= PHP 5.6 */);
    }
}