<?php
/**
 * Class FileSystemTrait
 * @author Leiha Sellier <leiha.sellier@gmail.com>
 * @link   https://github.com/leiha
 * -
 */

namespace OLD\Cube\FileSystem;

trait FileSystemBehavior
{
    private $configurator;

    /**
     * @param string $filePath
     * @param string $content
     * @param string $directoryId FileSystem::DIRECTORY_ID_
     */
    public function writeIn($filePath, $content, $directoryId = FileSystem::DIRECTORY_ID_CACHE)
    {
        file_put_contents($filePath, $content);
    }

    /**
     * @param \Closure $cbForEachFile (\DirectoryIterator $item)
     */
    public function iterateIncludePaths(\Closure $cbForEachFile)
    {
        foreach($this->includePaths as $includePath) {
            FileSystem::iterate($includePath, $cbForEachFile);
        }
    }
}