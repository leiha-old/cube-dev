<?php

namespace Cube\Router;

abstract class Router
    implements RouterInterface
{
    /**
     * @param string $type
     * @param string $pattern
     * @param string $controller
     * @param string $action
     * @return $this
     */
    abstract protected function addRoute($type, $pattern, $controller, $action);

    /**
     * @param string $pattern
     * @param string $controller
     * @param string $action
     * @return $this
     */
    public function get($pattern, $controller, $action)
    {
        return $this->addRoute('get', $pattern, $controller, $action);
    }

    /**
     * @param string $pattern
     * @param string $controller
     * @param string $action
     * @return $this
     */
    public function put($pattern, $controller, $action)
    {
        return $this->addRoute('put', $pattern, $controller, $action);
    }

    /**
     * @param string $pattern
     * @param string $controller
     * @param string $action
     * @return $this
     */
    public function post($pattern, $controller, $action)
    {
        return $this->addRoute('post', $pattern, $controller, $action);
    }

    /**
     * @param string $pattern
     * @param string $controller
     * @param string $action
     * @return $this
     */
    public function delete($pattern, $controller, $action)
    {
        return $this->addRoute('delete', $pattern, $controller, $action);
    }
}