<?php
/**
 * Class CollectionBehavior
 * @author Leiha Sellier <leiha.sellier@gmail.com>
 * @link   https://github.com/leiha
 * -
 */

namespace OLD\Cube\Collection;

trait CollectionBehavior
{
    /**
     * @var array
     */
    protected $_items;

    /**
     * @param array $items
     */
    public function __construct(array $items = array()) {
        $this->_items = $items;
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
            if($silent) {
                return null;
            } else {
                throw new CollectionException(
                    'Entry [ :itemKey: ] not present ! '
                    .'If you want to skip this message, put [ true ] on the second argument of get method',
                    compact('itemKey')
                );
            }
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
                    if (!$silent) {
                        throw new CollectionException(
                            'Entry [ item:railProgression: ] not present ! '
                            . 'If you want to skip this message, put [ true ] on the second argument of get method',
                            compact('railProgression')
                        );
                    }
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
            throw new CollectionException(
                'Entry [ :itemKey: ] already present, adding impossible !'
                .'If you want to skip this message, put [ true ] on the third argument of set method',
                compact('itemKey')
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
                    if (!$force) {
                        throw new CollectionException(
                            'Entry [ item:railProgression: ] not present ! '
                            . 'If you want force this action, put [ true ] on the third argument of set method',
                            compact('railProgression')
                        );
                    }
                    $item[$key] = array();
                    if ($isEnd) {
                        $item[$key] = &$value;
                    }
                } else {
                    if (!$force) {
                        throw new CollectionException(
                            'Entry [ item:railProgression: ] already present, adding impossible !'
                            . 'If you want force this action, put [ true ] on the third argument of set method',
                            compact('railProgression')
                        );
                    }

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
            Collection::iterateArray($array, $cbForEachItem, $reverseMode);
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
            Collection::iterateArray($array, $cbForEachItem, $reverseMode);
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
        return Collection::iterateArrayOnRail($this->_items, $rail, $cbForEachItem);
    }

    /**
     * @param \Closure $cbForEachItem ((&)$value, $key, $counter, $total)
     * @param bool $reverseMode
     * @return $this
     */
    public function iterateWithCounter(\Closure $cbForEachItem, $reverseMode = false)
    {
        Collection::iterateArrayWithCounter($this->_items, $cbForEachItem, $reverseMode);
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