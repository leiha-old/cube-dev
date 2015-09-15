<?php
/**
 * Class FileSystemTrait
 * @author Leiha Sellier <leiha.sellier@gmail.com>
 * @link   https://github.com/leiha
 * -
 */

namespace Cube\FileSystem;

use Cube\AutoLoaderException;
use Cube\Collection\Collection;

trait FileSystemTrait
{
    /**
     * @var Collection
     */
    private $classes;

    /**
     * @var Collection
     */
    private $behaviors;

    /**
     * @var array
     */
    private $includePaths;

    /**
     * @param string $path
     * @param \Closure $callback
     * @throws FileSystemException
     */
    public static function iterate($path, \Closure $callback)
    {
        $iterator = new \DirectoryIterator ( $path );
        foreach($iterator as $item){
            if($item->isDot()) {
                continue;
            }

            if($item->isDir()) {
                static::iterate($item->getPathname(), $callback);
                continue;
            }

            $callback($item);
        }
    }

    /**
     * @param array $includePaths
     */
    public function __construct(array $includePaths)
    {
        $this->classes      = Collection::instance();
        $this->behaviors    = Collection::instance();
        $this->includePaths = $includePaths;
    }

    public function init()
    {
        $this->iterateIncludePaths();
        $this->retrieve();

        print_r($this->behaviors->getAll());
    }

    /**
     * @param string $filePath
     * @param string $content
     * @param string $directoryId FileSystem::DIRECTORY_ID_
     */
    public function writeIn($filePath, $content, $directoryId = FileSystem::DIRECTORY_ID_CACHE)
    {
        file_put_contents($filePath, $content);
    }

    public function iterateIncludePaths()
    {
        foreach($this->includePaths as $includePath)
        {
            FileSystem::iterate(
                $includePath,
                function(\DirectoryIterator $item)
                    use ($includePath)
                {

                }
            );
        }
    }

    private function retrieve()
    {
        /**
         * @param array $traits
         * @param string $className
         * @internal param array $traits
         */
        $iterateClasses = function(array $traits, $className)
        {
            /**
             * @param array $behavior
             */
            $populateBehaviors = function(array &$behavior)
                use ($className, $traits)
            {
                // If Class has a Behavior trait we store the class name
                if(count($behavior) && in_array($behavior['trait'], $traits)) {
                    $behavior['classes'][] = $className;
                }
            };
            $this->behaviors->iterateItem('Inline', $populateBehaviors);
        };
        $this->classes->iterate($iterateClasses);
    }
}