<?php

namespace Cube;

include_once(__DIR__.'/FileSystem/AutoLoader/AutoLoader.php');

use Cube\Collection\CollectionBehavior;
use Cube\FileSystem\AutoLoader\AutoLoader;
use Cube\FileSystem\FileSystem;
use Cube\Poo\Exception\Exception;
use Cube\Poo\Single\SingleTraitStatic;

class Cube
    implements CubeConstants
{
    use SingleTraitStatic;
    use CollectionBehavior;

    /**
     * @var CubeConfigurator
     */
    private $configurator;

    /**
     * @param CubeConfigurator $configurator
     * @return $this
     */
    public function ____construct(CubeConfigurator $configurator)
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
            //$eClass = $this->configurator->getMapping(Cube::MAPPING_EXCEPTION);
            if(!($exception instanceof Exception)) {
                $e = new Exception($exception->getMessage());
                $e->setFile($exception->getFile(), $exception->getLine());
                $exception = $e;
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