<?php
/**
 * Class CubeInterface
 * @author Leiha Sellier <leiha.sellier@gmail.com>
 * @link   https://github.com/leiha
 * -
 */

namespace OLD\Cube\Cube;

use Cube\Collection\Collection;
use Cube\Collection\CollectionInterface;
use Cube\Dna\DnaInterface;

interface CubeInterface
{
    /**
     * @param string $msg
     * @param array $data
     * @param \Closure $callback
     * @throws CubeException
     */
    public static function exception($msg, array $data = array(), \Closure $callback = null);

    /**
     * Return single instance of Dna
     * @return DnaInterface
     */
    public static function dna();

    /**
     * Return new Collection object
     * @param array $items
     * @return Collection
     */
    public static function collection(array $items = array());
}