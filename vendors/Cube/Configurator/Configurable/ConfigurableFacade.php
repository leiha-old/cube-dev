<?php
/**
 * Created by PhpStorm.
 * User: lia
 * Date: 18/09/15
 * Time: 11:39
 */

namespace Cube\Configurator\Configurable;

use Cube\Configurator\Configurator;

interface ConfigurableFacade
{
    /**
     * @param Configurator $configurator
     * @return void
     */
    public static function ____configureSingle(Configurator $configurator=null);
}