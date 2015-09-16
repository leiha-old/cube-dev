<?php
/**
 * Class FileSystemBehaviorStatic
 * @author Leiha Sellier <leiha.sellier@gmail.com>
 * @link   https://github.com/leiha
 * -
 */

namespace Cube\FileSystem;

trait FileSystemBehaviorStatic
{
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
}