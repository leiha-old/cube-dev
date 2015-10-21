<?php
/**
 * Created by PhpStorm.
 * User: lia
 * Date: 15/10/15
 * Time: 15:16
 */

namespace Cube\Http;

use Cube\Application\ApplicationFacadeBehavior;
use Cube\Http\Router\Router;
use Cube\Poo\Facade\FacadeWrapper;
use Cube\Poo\Mapper\Mapper;

class HttpFacade
    extends    FacadeWrapper
    implements HttpFacadeBehavior
{
    /**
     * @param string $routerClass
     * @return HttpFacadeBehavior
     */
    public function mapRouter($routerClass)
    {
        Mapper::single()
            ->map(Http::HTTP_router, $routerClass)
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