<?php
/**
 * Class InstanceBehavior
 * @author Leiha Sellier <leiha.sellier@gmail.com>
 * @link   https://github.com/leiha
 * -
 */

namespace OLD\Cube\Core\Instance;

use Cube\Core\Configurator\Configurable\ConfigurableBehavior;

trait InstanceBehavior
{
    use ConfigurableBehavior;

    /**
     * @return $this
     */
    public static function instance()
    {
        return static::instanceTo(get_called_class(), func_get_args());
    }

    /**
     * @param string $className
     * @param array $args
     * @return object
     */
    public static function instanceTo($className, array $args = array())
    {
        return (new \ReflectionClass($className))
            ->newInstanceArgs($args)
            ;
    }
}