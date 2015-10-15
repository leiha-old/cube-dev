<?php
/**
 * Created by PhpStorm.
 * User: lia
 * Date: 15/10/15
 * Time: 15:09
 */

namespace Cube\Application;

use Cube\Application\Configurator\Http;
use Cube\CubeConfigurator;

class ApplicationConfigurator
    extends CubeConfigurator
{
    /**
     * @return Http
     */
    public function http() {
        return Http::single();
    }
}