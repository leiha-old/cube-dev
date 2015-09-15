<?php
/**
 * Class ConfigurableInterface
 * @author Leiha Sellier <leiha.sellier@gmail.com>
 * @link   https://github.com/leiha
 * -
 */

namespace Cube\Core\Configurator\Configurable;

interface ConfigurableInterface
{
    /**
     * @param ConfigurableConfigurator $configurator
     * @return mixed
     */
    public static function ____configureConfigurable(ConfigurableConfigurator $configurator);
}