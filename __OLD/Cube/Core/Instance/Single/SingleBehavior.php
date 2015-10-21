<?php
/**
 * Class SingleBehavior
 * @author Leiha Sellier <leiha.sellier@gmail.com>
 * @link   https://github.com/leiha
 * @design-pattern Singleton
 * -
 */

namespace OLD\Cube\Core\Instance\Single;

use Cube\Core\Instance\InstanceBehavior;

trait SingleBehavior
{
    use InstanceBehavior {
        instance   as protected;
        instanceTo as protected;
    }

    /**
     * @var static
     */
    private static $_SingleBehavior;

    /**
     * @return static
     */
    public static function single()
    {
        return static::singleTo(get_called_class(), func_get_args());
    }

    /**
     * @param string $className
     * @param array $args
     * @return static
     */
    public static function singleTo($className, array $args = array())
    {
        if(!static::$_SingleBehavior) {
            //static::$_single = new static();
            static::$_SingleBehavior = static::instanceTo($className, $args);
        }
        return static::$_SingleBehavior;
    }
}