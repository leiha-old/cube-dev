<?php

namespace Cube\Router;

interface RouterInterface
{
    /**
     * @param string $pattern
     * @param string $controller
     * @param string $action
     * @return $this
     */
    public function get($pattern, $controller, $action);

    /**
     * @param string $pattern
     * @param string $controller
     * @param string $action
     * @return $this
     */
    public function put($pattern, $controller, $action);

    /**
     * @param string $pattern
     * @param string $controller
     * @param string $action
     * @return $this
     */
    public function post($pattern, $controller, $action);

    /**
     * @param string $pattern
     * @param string $controller
     * @param string $action
     * @return $this
     */
    public function delete($pattern, $controller, $action);
}