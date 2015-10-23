<?php
/**
 * Created by PhpStorm.
 * User: lia
 * Date: 23/10/15
 * Time: 02:33
 */

namespace Cube\Http\Router;

use Cube\Http\Http;
use Cube\Poo\Facade\FacadeWrapper;
use Cube\Poo\Mapper\Mapper;

class RouterFacade
    extends FacadeWrapper
{
    /**
     * @param string $routerClass
     * @return RouterBehavior
     */
    public function map($routerClass)
    {
        Mapper::single()
            ->map(Http::Router, $routerClass)
        ;

        return $this;
    }

    /**
     * @param string $pattern
     * @param string $controllerName
     * @param string $methodName
     * @return $this
     */
    public function get($pattern, $controllerName, $methodName)
    {
        Router::single()
            ->get($pattern, $controllerName, $methodName)
        ;

        return $this;
    }

    /**
     * @param string $pattern
     * @param string $controllerName
     * @param string $methodName
     * @return $this
     */
    public function post($pattern, $controllerName, $methodName)
    {
        Router::single()
            ->post($pattern, $controllerName, $methodName)
        ;

        return $this;
    }

    /**
     * @param string $pattern
     * @param string $controllerName
     * @param string $methodName
     * @return $this
     */
    public function put($pattern, $controllerName, $methodName)
    {
        Router::single()
            ->put($pattern, $controllerName, $methodName)
        ;

        return $this;
    }

    /**
     * @param string $pattern
     * @param string $controllerName
     * @param string $methodName
     * @return $this
     */
    public function delete($pattern, $controllerName, $methodName)
    {
        Router::single()
            ->delete($pattern, $controllerName, $methodName)
        ;

        return $this;
    }

    /**
     * @return void
     */
    public function run()
    {
        Router::single()->run();
    }
}