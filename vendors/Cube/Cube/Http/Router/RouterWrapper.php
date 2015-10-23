<?php
/**
 * Created by PhpStorm.
 * User: lia
 * Date: 14/10/15
 * Time: 21:15
 */

namespace Cube\Http\Router;

use Cube\Poo\Mapper\Mappable\MappableHelper;
use Cube\Poo\Wrapper\Wrapper;

abstract class RouterWrapper
    extends    Wrapper
    implements RouterBehavior
{
    use RouterHelper;
    use MappableHelper;

    /**
     * @return void
     */
    abstract public function run();

    /**
     * @param $wrapped
     * @param array $args
     */
    public function __construct($wrapped, array $args = array())
    {
        $this->__constructWrapper($wrapped, $args);
    }
}