<?php
/**
 * Class FactoryBehavior
 * @author Leiha Sellier <leiha.sellier@gmail.com>
 * @link   https://github.com/leiha
 * @design-pattern Factory
 * -
 */

namespace OLD\Cube\Core\Instance\Factory;

use Cube\Collection\CollectionBehavior;
use Cube\Core\Instance\InstanceBehavior;

trait FactoryBehavior
{
    use InstanceBehavior {
        instance as private;
    }

    use CollectionBehavior {

    }

    /**
     * @param $className
     */
    public function __construct($className)
    {
        $this->setSingle($className);
    }

    /**
     * @return $this
     * @throws \Cube\Collection\CollectionException
     */
    public function getSingle()
    {
        return $this->get('__single__');
    }
}