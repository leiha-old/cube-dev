<?php
/**
 * Class LoaderInterface
 * @author Leiha Sellier <leiha.sellier@gmail.com>
 * @link   https://github.com/leiha
 * -
 */

namespace OLD\Cube\Dna\Loader;

interface LoaderInterface
{
    /**
     * @return LoaderInterface
     */
    public static function single();

    /**
     * @param string $className
     * @param string $type
     * @param bool $force
     * @return $this
     * @throws \Cube\Collection\CollectionException
     */
    public function load($className, $type = 'Lazy', $force = false);

    /**
     * @param string $className
     * @param bool $force
     * @return $this
     */
    public function loadOnLazy($className, $force = false);

    /**
     * @param string $className
     * @param bool $force
     */
    public function loadInCache($className, $force = false);
}