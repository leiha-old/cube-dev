<?php

namespace Cube\FileSystem;

trait FileSystemTraitStatic
{
    /**
     * @param string $path
     * @param \Closure $callback
     * @throws FileSystemException
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

            $callback($item);
        }
    }
}