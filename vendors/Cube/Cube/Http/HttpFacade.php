<?php
/**
 * Created by PhpStorm.
 * User: lia
 * Date: 15/10/15
 * Time: 15:16
 */

namespace Cube\Http;

use Cube\Poo\Facade\FacadeWrapper;

class HttpFacade
    extends    FacadeWrapper
    implements HttpFacadeBehavior
{
    /**
     * @var string
     */
    private $router = Http::HTTP_router;

    /**
     * @param string $routerClass
     * @return HttpFacadeBehavior
     */
    public function setRouterClass($routerClass)
    {
        $this->router = $routerClass;
        return $this;
    }

    /**
     * @return string
     */
    public function getRouterClass()
    {
        return $this->router;
    }

    public function router() {
        return;
    }
}