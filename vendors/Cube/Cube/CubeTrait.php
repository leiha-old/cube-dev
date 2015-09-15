<?php
/**
 * Class CubeTrait
 * @author Leiha Sellier <leiha.sellier@gmail.com>
 * @link   https://github.com/leiha
 * -
 */

namespace Cube\Cube;

use Cube\Collection\Collection;
use Cube\Core\Instance\Single\SingleBehavior;
use Cube\Dna\Dna;

trait CubeTrait
{
    use SingleBehavior;

    public static function info() {

    }

    public static function alert() {

    }

    public static function warn() {

    }

    public static function error() {

    }

    /**
     * @param string $msg
     * @param array $data
     * @param \Closure $callback
     * @throws CubeException
     */
    public static function exception($msg, array $data = array(), \Closure $callback = null) {
        throw new CubeException($msg, $data, $callback);
    }

    /**
     * Return single instance of Dna
     * @return Dna
     */
    public static function dna() {
        return Dna::single();
    }

    /**
     * Return new Collection object
     * @param array $items
     * @return Collection
     */
    public static function Collection(array $items = array()) {
        return Collection::instance($items);
    }
}