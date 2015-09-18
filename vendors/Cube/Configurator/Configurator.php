<?php
/**
 * Created by PhpStorm.
 * User: lia
 * Date: 18/09/15
 * Time: 11:41
 */

namespace Cube\Configurator;

use Cube\Collection\CollectionBehavior;
use Cube\CubeConfiguratorConstants;
use OLD\Cube\Collection\Collection;

class Configurator
    implements CubeConfiguratorConstants
{
    use CollectionBehavior {
        ____init as protected ____initCollection;
    }

    private static $mapping = array(
        self::MAPPING_EXCEPTION_DEFAULT => 'Cube\Poo\Exception\Exception'
    );

    /**
     */
    public function ____init() {
        $this->____initCollection(array(
            'mapping' => Collection::instance(self::$mapping)
        ));
    }

    /**
     * @param string $mapName MAPPING_*
     * @param bool   $silent
     * @return string
     */
    public function getMapping($mapName, $silent = false) {
        return $this->getRail(['mapping', $mapName], $silent);
    }


}