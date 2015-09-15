<?php

namespace Cube\Collection;

use Cube\Core\Instance\InstanceBehavior;

class Collection
    implements CollectionInterface
{
    use CollectionBehavior;
    use InstanceBehavior;

    const SORT_REGULAR = SORT_REGULAR;

    const SORT_NUMERIC = SORT_NUMERIC;

    const SORT_STRING  = SORT_STRING;

    const SORT_NATURAL = SORT_NATURAL;

    /**
     * @param array &$items
     * @param \Closure $callback ((&)$value, $key)
     * @param bool $reverseMode
     */
    public static function iterateArray(array &$items, \Closure $callback, $reverseMode = false)
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
    public static function iterateArrayWithCounter(array &$items, \Closure $callback, $reverseMode = false)
    {
        if($reverseMode) {
            $items = array_reverse($items);
        }

        $itemKeys = array_keys($items);
        for($i = 0, $c = count($itemKeys), $cc = $c - 1; $i < $c; $i++) {
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
     * @return mixed
     */
    public static function &iterateArrayOnRail(array &$items, array $rail, \Closure $cbForEachItem)
    {
        $item[-1] = &$items;
        $railProgression = array();
        for($i = 0, $c = count($rail), $cc = $c - 1; $i < $c; $i++)
        {
            $isEnd  = $i == $cc;
            $railProgression[] = $key = $rail[$i];
            if (isset($item[$i - 1][$key])) {
                $item[$i] = &$item[$i - 1][$key];
                $cbForEachItem(true, $isEnd, $item[$i], $key, $railProgression);
            } else {
                $cbForEachItem(false, $isEnd, $item[$i - 1], $key, $railProgression);
                $item[$i] = &$item[$i - 1][$key];
            }
        }
        return $item[$i-1];
    }

}