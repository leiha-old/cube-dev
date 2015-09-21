<?php

namespace Cube\FileSystem;

use Cube\Poo\Mapper\MapperConfigurator;
use Cube\Poo\Mapper\MapperFacade;

class FileSystem
    implements FileSystemConstants
{
    use MapperFacade;
    use FileSystemTraitStatic;

    /**
     * @param MapperConfigurator $configurator
     * @return mixed
     */
    public function ____configureBehavior(MapperConfigurator $configurator)
    {
        // TODO: Implement ____configureBehavior() method.
    }

    private $includePaths;

    /**
     * @param array $includePaths
     */
    public function __construct(array $includePaths) {
        $this->includePaths = $includePaths;
    }

    /**
     * @param \Closure $cbForEachFile (\DirectoryIterator $item)
     */
    public function iterateIncludePaths(\Closure $cbForEachFile)
    {
        foreach($this->includePaths as $includePath) {
            $this->iterateOn($includePath, $cbForEachFile);
        }
    }
}