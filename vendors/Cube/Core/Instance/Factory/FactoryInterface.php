<?php
/**
 * Class FactoryInterface
 * @author Leiha Sellier <leiha.sellier@gmail.com>
 * @link   https://github.com/leiha
 * -
 */

namespace Cube\Core\Instance\Factory;

interface FactoryInterface
{
    /**
     * @param string $mapName
     * @param string $className
     * @param bool   $force
     * @return $this
     */
    public function set($className, $mapName = '', $force = false);

    /**
     * @param string $mapName
     * @param bool   $silent
     * @return $this
     */
    public function get($mapName, $silent = false);

}