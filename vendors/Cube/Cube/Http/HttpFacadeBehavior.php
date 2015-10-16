<?php
/**
 * Created by PhpStorm.
 * User: lia
 * Date: 15/10/15
 * Time: 23:38
 */

namespace Cube\Http;

use Cube\Application\ApplicationFacadeBehavior;
use Cube\Http\Router\RouterBehavior;
use Cube\Poo\Facade\FacadeBehavior;

interface HttpFacadeBehavior
    extends FacadeBehavior, RouterBehavior
{
    /**
     * @return ApplicationFacadeBehavior
     */
    public function end();

    /**
     * @param string $routerClass
     * @return HttpFacadeBehavior
     */
    public function mapRouter($routerClass);

    /**
     * @param string $pattern
     * @param string $controllerName
     * @param string $methodName
     * @return HttpFacadeBehavior
     */
    public function get($pattern, $controllerName, $methodName);

    /**
     * @param string $pattern
     * @param string $controllerName
     * @param string $methodName
     * @return HttpFacadeBehavior
     */
    public function post($pattern, $controllerName, $methodName);

    /**
     * @param string $pattern
     * @param string $controllerName
     * @param string $methodName
     * @return HttpFacadeBehavior
     */
    public function put($pattern, $controllerName, $methodName);

    /**
     * @param string $pattern
     * @param string $controllerName
     * @param string $methodName
     * @return HttpFacadeBehavior
     */
    public function delete($pattern, $controllerName, $methodName);
}