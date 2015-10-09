<?php
/**
 * Class CollectionServiceHelper
 * @author Leiha Sellier <leiha.sellier@gmail.com>
 * @link   https://github.com/leiha
 * -
 */

namespace Cube\Collection;

trait CollectionServiceHelper
{
	/**
	 * @param string $msg
	 * @param array  $data
	 * @param bool   $silent
	 * @return void|false
	 * @throws CollectionException
	 */
	public function exception($msg, array $data = array(), $silent = false) {
		if(!$silent) {
			throw CollectionException::instance($msg, $data);
		}
		return false;
	}

	/**
	 * @param array &$items
	 * @param \Closure $callback ((&)$value, $key)
	 * @param bool $reverseMode
	 */
	public function iterateArray(array &$items, \Closure $callback, $reverseMode = false)
	{
		if($reverseMode) {
			$items = array_reverse($items);
		}

		//array_walk($items, $callback);
		foreach($items as $itemKey => &$item) {
			$callback($item, $itemKey);
		}

		if($reverseMode) {
			$items = array_reverse($items);
		}
	}

	/**
	 * @param array &$items
	 * @param \Closure $callback ($isEnd, (&)$value, $key, $counter, $total)
	 * @param bool $reverseMode
	 */
	public function iterateArrayWithCounter(array &$items, \Closure $callback, $reverseMode = false)
	{
		if($reverseMode) {
			$items = array_reverse($items);
		}

		$itemKeys = array_keys($items);
		for($i = 0, $c = count($itemKeys), $cc = $c - 1; $i < $c; $i++)
		{
			$itemKey = $itemKeys[$i];
			if($callback($i == $cc, $items[$itemKey], $itemKey, $i, $c)){
				return;
			}
		}

		if($reverseMode) {
			$items = array_reverse($items);
		}
	}

	/**
	 * @param array &$items
	 * @param array $rail Array with the tree of itemKeys
	 * @param \Closure $cbForEachItem ($exist, $isEnd, (&)$item, $key, $railProgression)
	 * @param bool $silent
	 * @return mixed
	 */
	public function &iterateArrayOnRail(array &$items, array $rail, \Closure $cbForEachItem, $silent = false)
	{
		$item[-1] = &$items;

		$railProgression = array();
		for($i = 0, $c = count($rail), $cc = $c - 1; $i < $c; $i++)
		{
			$isEnd  = $i == $cc;
			$railProgression[] = $key = $rail[$i];

			$h = $i - 1;
			if($item[$h] instanceof Collection) {
				/** @var $item Collection[] */
				$tmp = &$item[$h]->get($key, $silent);
			}
			elseif (is_array($item[$h])) {
				$tmp = &$item[$h];
			}
//			elseif(!$isEnd) {
//				self::exception(Collection::ERROR_DATA_ERROR);
//			}

			if(false === $cbForEachItem($tmp, $isEnd, $key, $railProgression)) {

			}

		}
		return $item[$i-1];
	}
}