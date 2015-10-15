<?php
/**
 * Created by PhpStorm.
 * User: lia
 * Date: 15/10/15
 * Time: 15:16
 */

namespace Cube\Application\Configurator;

use Cube\Poo\Mapper\Mappable\MappableHelper;

class Http
{
    use MappableHelper;

    /**
     * @var string
     */
    private $router;

    /**
     * @param string $routerClass
     * @return $this
     */
    public function setRouter($routerClass)
    {
        $this->router = $routerClass;
        return $this;
    }

    /**
     * @return string
     */
    public function getRouter()
    {
        return $this->router;
    }
}