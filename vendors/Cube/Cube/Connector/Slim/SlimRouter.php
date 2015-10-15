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
     * @param string $type [get|put|post|delete]
     * @param string $pattern
     * @param string $controllerName
     * @param string $methodName
     * @return $this
     */
    protected function addRoute($type, $pattern, $controllerName, $methodName) {
        $this->getWrapped()->get($pattern,
            function(Request $request, Response $response, array $args)
            use ($controllerName, $methodName)
            {
                return (new $controllerName())->$methodName(func_get_args());
            });
        return $this;
    }

    /**
     * @param string $pattern
     * @param string $controllerName
     * @param string $methodName
     * @return SlimRouter|void
     */
    public function get($pattern, $controllerName, $methodName)
    {
        return $this->addRoute('get', $pattern, $controllerName, $methodName);
    }

    /**
     * @param string $pattern
     * @param string $controllerName
     * @param string $methodName
     * @return SlimRouter|void
     */
    public function post($pattern, $controllerName, $methodName)
    {
        return $this->addRoute('post', $pattern, $controllerName, $methodName);
    }

    /**
     * @param string $pattern
     * @param string $controllerName
     * @param string $methodName
     * @return SlimRouter|void
     */
    public function put($pattern, $controllerName, $methodName)
    {
        return $this->addRoute('put', $pattern, $controllerName, $methodName);
    }

    /**
     * @param string $pattern
     * @param string $controllerName
     * @param string $methodName
     * @return SlimRouter|void
     */
    public function delete($pattern, $controllerName, $methodName)
    {
        return $this->addRoute('delete', $pattern, $controllerName, $methodName);
    }
}