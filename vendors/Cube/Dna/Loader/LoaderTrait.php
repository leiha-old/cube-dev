<?php
/**
 * Class LoaderTrait
 * @author Leiha Sellier <leiha.sellier@gmail.com>
 * @link   https://github.com/leiha
 * -
 */

namespace Cube\Dna\Loader;

use Cube\Collection\CollectionException;

trait LoaderTrait
{
    /**
     * @param string $className
     * @param string $type
     * @param bool $force
     * @return LoaderInterface
     * @throws \Cube\Collection\CollectionException
     */
    public function load($className, $type = 'Lazy', $force = false)
    {
        return $this->{'loadWith'.$type}($className, $force);
    }

    /**
     * @param string $className
     * @param bool $force
     * @return LoaderInterface
     */
    public function loadOnLazy($className, $force = false)
    {
        return $this->set($className, array('Lazy', $this->____getLazyCallBack(), $force));
    }

    /**
     * Can be overridden
     * Used in LoaderTrait::loadWithLazy
     * @return \Closure ($className, LoaderConfigurator $configurator)
     */
    abstract protected function ____getLazyCallBack();

    /**
     * @param string $itemKey
     * @param mixed $value
     * @param bool $force
     * @return $this
     * @throws CollectionException
     */
    abstract protected function set($itemKey, $value, $force = false);

    /**
     * @param string $className
     * @param bool $force
     */
    public function loadInCache($className, $force = false)
    {
        // @Todo : Make ME plz ! ;)
    }}