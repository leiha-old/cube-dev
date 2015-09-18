<?php
/**
 * Class SingleSample
 * @author Leiha Sellier <leiha.sellier@gmail.com>
 * @link   https://github.com/leiha
 * -
 */

namespace OLD\Cube\Core\Instance\Single;

use Cube\Core\Configurator\Configurable\ConfigurableConfigurator;

class SingleSample
    implements SingleInterface
{
    use SingleBehavior;

    /**
     * @param ConfigurableConfigurator $configurator
     * @return mixed
     */
    public static function ____configureConfigurable(ConfigurableConfigurator $configurator)
    {
        // TODO: Implement configureConfigurable() method.
    }

    /**
     * @param SingleConfigurator $configurator
     */
    public static function ____configureSingle(SingleConfigurator $configurator)
    {
        // TODO: Implement single() method.
    }
}