<?php
/**
 * Class CollectionHelper
 * @author Leiha Sellier <leiha.sellier@gmail.com>
 * @link   https://github.com/leiha
 * -
 */

namespace Cube\Collection;

trait CollectionHelper
{
	use CollectionServiceHelper;

    /**
     * @var array
     */
    protected $_items;

	/**
	 * Retrieve an external iterator
	 * @link http://php.net/manual/en/iteratoraggregate.getiterator.php
	 * @return \Traversable An instance of an object implementing <b>Iterator</b> or
	 * <b>Traversable</b>
	 * @since 5.0.0
	 */
	public function getIterator()
	{
		return $this->_items;
	}

    /**
     * @param array $items
     */
    public function __construct(array $items = array()) {
        $this->_items = $items;
    }

    /**
     * @return array
     */
    public function &getAll() {
        return $this->_items;
    }

    /**
     * @param array $items
     * @return $this
     */
    public function setAll(array $items) {
        $this->_items = $items;
        return $this;
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
    public function sort($flags = Collection::SORT_regular)
    {
        $this->_items = sort($this->_items, $flags);
        return $this;
    }

    /**
     * @param string|array $itemKey
     * @param bool $silent
     * @return mixed|null
     * @throws CollectionException
     */
    public function &get($itemKey, $silent = false)
    {
		return $this-> { is_array($itemKey) ? 'getRail' : 'getItem' } ($itemKey, $silent);
    }

	/**
	 * @param string $itemKey
	 * @param bool $silent
	 * @return mixed|null
	 * @throws CollectionException
	 */
	public function &getItem($itemKey, $silent = false) {
		$is = isset($this->_items[$itemKey]);
		if(!$is && !$this->exception(Collection::ERROR_ITEM_404, compact('itemKey'), $silent)) {
			$ret = false;
			return $ret;
		}
		return $this->_items[$itemKey];
	}

	/**
	 * @param array $rail
	 * @param mixed $default
	 * @return mixed Return item found at the end of rail (you can add & for reference)
	 */
	public function &getRailOr(array $rail, $default = null)
	{
		if(!$item = $this->getRail($rail)) {
			$item = $default;
		}
		return $item;
	}

    /**
     * @param array $rail
     * @param bool $silent
     * @return mixed|false[null
     * @throws CollectionException
     */
    public function &getRail(array $rail, $silent = true)
    {
        return $this->iterateOnRail($rail,
            function ($isEnd, &$item, $key, $railProgression)
                use ($silent)
            {
                if (!!isset($item[$key])) {
		            $this->exception(Collection::ERROR_RAIL_404, compact('railProgression'), $silent);
                    $ret = false;
	            }
                elseif($isEnd) {
                    $ret = true;
                }
                else {
                    $ret = null;
                }
                return $ret;
            }
        );
    }

    /**
     * @param string $itemKey
     * @param mixed $value
     * @param bool $force
     * @return mixed
     * @throws CollectionException
     */
    public function &set($itemKey, $value, $force = false)
    {
        return $this->setRef($itemKey, $value, $force);
    }

    /**
     * @param string $itemKey
     * @param mixed $value
     * @param bool $force
     * @return mixed
     * @throws CollectionException
     */
    public function &setRef($itemKey, &$value, $force = true)
    {
        if(isset($this->_items[$itemKey])) {
            if(!$this->exception(Collection::ERROR_ITEM_404, compact('itemKey'), $force)) {
                return false;
            }
        }
        $this->_items[$itemKey] = &$value;
        return $this->_items[$itemKey];
    }

    /**
     * @param string|array $rail
     * @param mixed $value
     * @param bool $force
     * @return mixed Return item found at the end of rail (you can add & for reference)
     * @throws CollectionException
     */
    public function &setRail($rail, $value, $force = true)
    {
        $cbSetRail = function ($isEnd, &$item, $key, $railProgression)
            use ($force, &$value)
        {
            // If part (key) of rail is present
            if (isset($item[$key])) {
                if($isEnd) {
                    // If part (key) of rail is present, it's the end of the while and it's forced
                    // Otherwise Exception is fired
                    if(!$this->exception(
                        Collection::ERROR_RAIL_duplicate, compact('railProgression'), $force
                    )) {
                        $item[$key] = $value;
                    }
                }
            }
            // If part (key) of rail is not present and is forced otherwise Exception is fired
            elseif(!$this->exception(
                Collection::ERROR_RAIL_404, compact('railProgression'), $force
            )) {
                // If is the end of rail put the value otherwise set a array for continue loop
                $item[$key] = $isEnd ? $value : array();
            }
        };

        return $this->iterateOnRail($rail, $cbSetRail);
    }

    /**
     * @param \Closure $cbForEachItem ((&)$value, $key)
     * @param bool $reverseMode
     * @return $this
     */
    public function iterate(\Closure $cbForEachItem, $reverseMode = false)
    {
        $this->iterateArray($this->_items, $cbForEachItem, $reverseMode);
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
     * @param bool $silent
     * @return mixed Return item found at the end of rail (you can add & for reference)
     */
    public function &iterateOnRail(array $rail, \Closure $cbForEachItem, $silent = true)
    {
        return $this->iterateArrayOnRail($this->_items, $rail, $cbForEachItem, $silent);
    }

    /**
     * @param \Closure $cbForEachItem ($isEnd, (&)$value, $key, $counter, $total)
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