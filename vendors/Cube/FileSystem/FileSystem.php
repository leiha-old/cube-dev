<?php

namespace Cube\FileSystem;

use Cube\Poo\Instance\InstanceTraitStatic;

class FileSystem
    implements FileSystemConstants
{
    use InstanceTraitStatic;
    use FileSystemTraitStatic;

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