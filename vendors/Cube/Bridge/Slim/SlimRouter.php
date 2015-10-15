<?php


namespace Cube\Connector\Slim;

use Cube\Router\Router;
use Slim\Slim;

class SlimRouter
    extends Router
{
    /**
     * Constructor
     * @param  array $userSettings Associative array of application settings
     */
    public function __construct(array $userSettings = array())
    {
        $this->setWrapper(new Slim($userSettings));
    }

    /**
     * @return Slim
     */
    public function getWrapped()
    {
        return parent::getWrapped();
    }

    /**
     * @return void
     */
    public function run() {
        $this->getWrapped()->run();
    }

    /**
     * @param string $type [get|put|post|delete]
     * @param string $pattern
     * @param string $controller
     * @param string $action
     * @return $this
     */
    protected function addRoute($type, $pattern, $controller, $action) {
        $this->getWrapped()
            ->$type($pattern, function ()
                use ($controller, $action)
            {
                return (new $controller())->$action(func_get_args());
            });
        return $this;
    }
}