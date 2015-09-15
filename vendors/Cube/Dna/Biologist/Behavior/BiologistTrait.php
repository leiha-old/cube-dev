<?php
/**
 * Class BiologistBehavior
 * @author Leiha Sellier <leiha.sellier@gmail.com>
 * @link   https://github.com/leiha
 * -
 */

namespace Cube\Dna\Biologist\Behavior;

use Cube\Cube\CubeTrait;
use Cube\Dna\Biologist\BiologistException;
use Cube\Dna\Biologist\Reflection\ReflectionTrait;

trait BiologistTrait
{
    use CubeTrait, ReflectionTrait;

    /**
     * @param string $msg
     * @param array $data
     * @param \Closure $callback
     * @throws BiologistException
     */
    public static function exception($msg, array $data = array(), \Closure $callback = null)
    {
        throw new BiologistException($msg, $data, $callback);
    }
}