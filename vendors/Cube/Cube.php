<?php

namespace Cube;

include_once(__DIR__.'/FileSystem/AutoLoader/AutoLoader.php');

use Cube\Collection\CollectionBehavior;
use Cube\Configurator\Configurator;
use Cube\FileSystem\AutoLoader\AutoLoader;
use Cube\FileSystem\FileSystem;
use Cube\Poo\Exception\Exception;
use Cube\Poo\Single\SingleTraitStatic;

class Cube
{
    use SingleTraitStatic;
    use CollectionBehavior;

    /**
     * @var Configurator
     */
    private $configurator;

    /**
     * @param \Closure|null $configurator
     */
    public function __construct(\Closure $configurator)
    {
        $className = get_called_class().'Configurator';

        $this->configurator = new $className();

        $configurator($this->configurator, $this);
    }

    /**
     * @param Configurator $configurator
     * @return $this
     */
    public function setConfigurator (Configurator $configurator)
    {
        $this->configurator = $configurator;
        return $this;
    }

    /**
     * @return $this
     */
    public function initException ()
    {
        $handler = function(\Exception $exception){
            if(!($exception instanceof Exception)) {
                $exception = new Exception($exception->getMessage());
            }

            print($exception->render());
            exit;
        };
        set_exception_handler($handler);
        return $this;
    }

    /**
     * @return $this
     */
    public function initFileSystem ()
    {
        $fs = FileSystem::instance(AutoLoader::getListOfIncludeFiles());
        $cbForEachFile = function(\DirectoryIterator $item) {

        };
        $fs->iterateIncludePaths($cbForEachFile);
        return $this;
    }

}