<?php
/**
 * Class Service
 * @author Leiha Sellier <leiha.sellier@gmail.com>
 * @link   https://github.com/leiha
 * -
 */

namespace Cube\Poo\Service;

use Cube\Collection\Collection;
use Cube\Poo\Service\Injectable\InjectableBehavior;

class Service
{
    const SERVICE_TYPE_instance = 'instance';

    /**
     * @var Collection
     */
    private $services;


    public function __construct() {
        $this->services = Collection::instance();
    }

    /**
     * @param string $serviceName
     * @param InjectableBehavior $service
     * @return $this
     */
    public function injectInstance($serviceName, InjectableBehavior $service)
    {
        return $this->inject(self::SERVICE_TYPE_instance, $serviceName, $service);
    }

    /**
     * @param \Closure $cbForEachItem ((&)$value, $key)
     * @return $this
     */
    public function iterateOnService(\Closure $cbForEachItem)
    {
        return $this->services->iterate($cbForEachItem);
    }

    /**
     * @param string $type
     * @param string $serviceName
     * @param InjectableBehavior|\Closure $service
     * @return $this
     */
    private function inject($type, $serviceName, $service)
    {
        $this->services->set($serviceName, compact('type', 'service'));
        return $this;
    }
}