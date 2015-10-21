<?php
/**
 * Class InstanceInterface
 * @author Leiha Sellier <leiha.sellier@gmail.com>
 * @link   https://github.com/leiha
 * -
 */

namespace OLD\Cube\Core\Instance;

use Cube\Core\Configurator\Configurable\ConfigurableInterface;

interface InstanceInterface
    extends ConfigurableInterface
{
    /**
     * @param SingleConfigurator $configurator
     */
    public static function ____configureInstance(SingleConfigurator $configurator);
;
    /**
     * @return $this
     */
    public static function instance();

    /**
     * @param string $className
     * @param array $args
     * @return object
     */
    public static function instanceTo($className, array $args = array());
}