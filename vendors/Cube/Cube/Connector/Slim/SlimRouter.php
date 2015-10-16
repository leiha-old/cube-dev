<?php
/**
 * Created by PhpStorm.
 * User: lia
 * Date: 14/10/15
 * Time: 21:21
 */

namespace Cube\Connector\Slim;

use Cube\Http\Router\RouterWrapper;
use Cube\Poo\Single\SingleHelper;
use Slim\Slim;

class SlimRouter
    extends RouterWrapper
{
    use SingleHelper;

    /**
     * @param array $args
     */
    public function __construct(array $args = array()){
        parent::__construct('\Slim\Slim', array(
            array(
            'debug' => true
            )
        ));

        unset($this->getWrapped()->container['errorHandler']);
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
        $this->getWrapped()->$type($pattern,
            function()//Request $request, Response $response, array $args
                use ($controllerName, $methodName)
            {
                return call_user_func_array(array(new $controllerName(), $methodName), func_get_args());
            });
        return $this;
    }

    public function run()
    {
        $this->getWrapped()->run();
    }
}