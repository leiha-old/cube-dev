<?php
/**
 * Created by PhpStorm.
 * User: lia
 * Date: 15/10/15
 * Time: 21:46
 */

namespace Cube\FileSystem;

use Cube\FileSystem\AutoLoader\AutoLoader;
use Cube\FileSystem\AutoLoader\AutoLoaderError;
use Cube\FileSystem\Crawler\Crawler;

trait FileSystemHelper
{
    /**
     * @var array
     */
    protected $includePaths;

    /**
     * @param string $path
     * @param \Closure $callback ($item, $path)
     * @throws FileSystemError
     */
    public static function iterateOn($path, \Closure $callback)
    {
        $iterator = new \DirectoryIterator ( $path );
        foreach($iterator as $item){
            if($item->isDot()) {
                continue;
            }

            if($item->isDir()) {
                static::iterateOn($item->getPathname(), $callback);
                continue;
            }

            $callback($item, $path);
        }
    }

    /**
     * @return Crawler
     */
    public function crawler(){
        return Crawler::single($this);
    }

    /**
     * @param string    $className
     * @param bool      $silent
     * @return bool
     * @throws AutoLoaderError
     */
    public function isClass($className, $silent = true) {
        return AutoLoader::loadClass($className, $silent);
    }

    /**
     * @param \Closure $cbForEachFile (\DirectoryIterator $item)
     * @throws FileSystemError
     */
    public function iterateIncludePaths(\Closure $cbForEachFile)
    {
        foreach($this->includePaths as $includePath) {
            self::iterateOn($includePath,
                function(\DirectoryIterator $item)
                use ($includePath, $cbForEachFile)
                {
                    $cbForEachFile($item, $includePath);
                }
            );
        }
    }
}