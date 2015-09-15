<?php
/**
 * Class DnaBehavior
 * @author Leiha Sellier <leiha.sellier@gmail.com>
 * @link   https://github.com/leiha
 * -
 */

namespace Cube\Dna;

use Cube\Dna\Behaviorist\Behaviorist;
use Cube\Dna\Biologist\Biologist;
use Cube\Dna\Injector\Injector;
use Cube\Dna\Injector\InjectorInterface;
use Cube\Dna\Loader\Loader;
use Cube\Dna\Loader\LoaderInterface;
use Cube\Dna\Mapper\Mapper;
use Cube\Dna\Observer\Observer;

trait DnaBehavior
{
    /**
     * @param DnaConfigurator $configurator
     * @return mixed
     */
    abstract public function ____configureDna(DnaConfigurator $configurator);

    /**
     * @param string $msg
     * @param array $data
     * @param \Closure|null $callback
     * @throws DnaException
     */
    public static function exception($msg, array $data = array(), \Closure $callback = null)
    {
        throw new DnaException($msg, $data, $callback);
    }

    /**
     * @return Behaviorist
     */
    public static function behaviorist()
    {
        return Behaviorist::single();
    }

    /**
     * @return Biologist
     */
    public static function biologist()
    {
        return Biologist::single();
    }

    /**
     * @return InjectorInterface
     */
    public static function injector()
    {
        return Injector::single();
    }

    /**
     * @return LoaderInterface
     */
    public static function loader()
    {
        return Loader::single();
    }

    /**
     * @return Mapper
     */
    public static function mapper()
    {
        return Mapper::single();
    }

    /**
     * @return Observer
     */
    public static function observer()
    {
        return Observer::single();
    }


}