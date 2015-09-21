<?php

namespace Cube;

include_once(__DIR__.'/FileSystem/AutoLoader/AutoLoader.php');

use Cube\FileSystem\AutoLoader\AutoLoader;
use Cube\FileSystem\FileSystem;
use Cube\Poo\Exception\Exception;
use Cube\Poo\Mapper\MapperConfigurator;
use Cube\Poo\Mapper\MapperFacade;

class Cube
    implements CubeConstants
{
    use MapperFacade;

    /**
     * @param MapperConfigurator $configurator
     * @return mixed
     */
    public function ____configureBehavior(MapperConfigurator $configurator)
    {
        // TODO: Implement ____configureBehavior() method.
    }


    /**
     * @return $this
     */
    public function initException ()
    {
        $handler = function(\Exception $exception){
            //$eClass = $this->configurator->getMapping(Cube::MAPPING_EXCEPTION);
            if(!($exception instanceof Exception)) {
                $e = Exception::instance($exception->getMessage());
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