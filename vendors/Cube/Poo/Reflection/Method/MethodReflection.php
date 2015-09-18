<?php
/**
 * Class ReflectionMethod
 * @author Leiha Sellier <leiha.sellier@gmail.com>
 * @link   https://github.com/leiha
 * -
 */

namespace Cube\Poo\Reflection\Method;

use Cube\Poo\Reflection\Closure\ClosureReflectionTrait;

class MethodReflection
    extends \ReflectionMethod
{
    use ClosureReflectionTrait;
}