<?php
/**
 * Created by PhpStorm.
 * User: lia
 * Date: 15/10/15
 * Time: 20:12
 */

namespace Cube\Http\Router;

class Router
    extends RouterWrapper
{
    public function __construct()
    {
        parent::__construct($this);
    }

    /**
     * @param string $type
     * @param string $pattern
     * @param string $controller
     * @param string $action
     * @return $this
     */
    protected function addRoute($type, $pattern, $controller, $action)
    {
        // TODO: Implement addRoute() method.
    }

    /**
     * @return void
     */
    public function run()
    {
        // TODO: Implement run() method.
    }
}