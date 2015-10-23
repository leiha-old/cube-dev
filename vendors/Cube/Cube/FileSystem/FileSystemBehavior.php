<?php
/**
 * Created by PhpStorm.
 * User: lia
 * Date: 16/10/15
 * Time: 00:00
 */

namespace Cube\FileSystem;

interface FileSystemBehavior
{
    /**
     * @param string $fileSystemClass
     * @return FileSystemBehavior
     */
    public function setFileSystemClass($fileSystemClass);

    /**
     * @param string $name
     * @param string $includePath
     * @param bool $vendor
     * @return FileSystemBehavior
     */
    public function addIncludePath($name, $includePath, $vendor = false);

    /**
     * @return string
     */
    public function getFileSystemClass();
}