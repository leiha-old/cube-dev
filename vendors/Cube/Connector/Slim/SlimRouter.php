<?php
/**
 * Created by PhpStorm.
 * User: lia
 * Date: 14/10/15
 * Time: 21:21
 */

namespace Cube\Connector\Slim;

use Cube\Http\Router\RouterWrapper;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Slim;

class SlimRouter
    extends RouterWrapper
{
    /**
     * @param array $args
     */
    public function __construct(array $args = array()){
        parent::__construct('\Slim\Slim', $args);
    }

    /**
     * @return Slim
     */
    public function getWrapped() {
        return parent::getWrapped();
    }

    /**
     * @param string $pattern
     * @param string $controllerName
     * @param string $methodName
     */
    public function get($pattern, $controllerName, $methodName)
    {
        $this->getWrapped()->get($pattern,
            function(Request $request, Response $response, array $args)
                use ($controllerName, $methodName)
            {

            }
        );
    }

    /**
     * @param string $pattern
     * @param string $controllerName
     * @param string $methodName
     */
    public function post($pattern, $controllerName, $methodName)
    {
        // TODO: Implement post() method.
    }

    /**
     * @param string $pattern
     * @param string $controllerName
     * @param string $methodName
     */
    public function put($pattern, $controllerName, $methodName)
    {
        // TODO: Implement put() method.
    }

    /**
     * @param string $pattern
     * @param string $controllerName
     * @param string $methodName
     */
    public function delete($pattern, $controllerName, $methodName)
    {
        // TODO: Implement delete() method.
    }
}