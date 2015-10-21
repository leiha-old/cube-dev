<?php
/**
 * Class SingleInterface
 * @author Leiha Sellier <leiha.sellier@gmail.com>
 * @link   https://github.com/leiha
 * -
 */

namespace OLD\Cube\Core\Instance\Single;

use Cube\Core\Configurator\Configurable\ConfigurableInterface;

interface SingleInterface
    extends ConfigurableInterface
{
    /**
     * @param SingleConfigurator $configurator
     */
    public static function ____configureSingle(SingleConfigurator $configurator);
;
    /**
     * @return static
     */
    public static function single();

    /**
     * @param string $className
     * @param array $args
     * @return static
     */
    public static function singleTo($className, array $args = array());
}