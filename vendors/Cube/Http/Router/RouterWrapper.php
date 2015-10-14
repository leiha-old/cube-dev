<?php
/**
 * Created by PhpStorm.
 * User: lia
 * Date: 14/10/15
 * Time: 21:15
 */

namespace Cube\Http\Router;

use Cube\Poo\Wrapper\Wrapper;

abstract class RouterWrapper
    extends    Wrapper
    implements RouterBehavior
{
    /**
     * @param string $pattern
     * @param string $controllerName
     * @param string $methodName
     */
    public function get($pattern, $controllerName, $methodName)
    {

    }

    /**
     * @param string $pattern
     * @param string $controllerName
     * @param string $methodName
     */
    public function post($pattern, $controllerName, $methodName)
    {

    }

    /**
     * @param string $pattern
     * @param string $controllerName
     * @param string $methodName
     */
    public function put($pattern, $controllerName, $methodName)
    {

    }

    /**
     * @param string $pattern
     * @param string $controllerName
     * @param string $methodName
     */
    public function delete($pattern, $controllerName, $methodName)
    {

    }
}