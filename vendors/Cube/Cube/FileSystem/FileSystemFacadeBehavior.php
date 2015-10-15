<?php
/**
 * Created by PhpStorm.
 * User: lia
 * Date: 16/10/15
 * Time: 00:00
 */

namespace Cube\FileSystem;

use Cube\Application\ApplicationFacadeBehavior;

interface FileSystemFacadeBehavior
{
    /**
     * @return ApplicationFacadeBehavior
     */
    public function end();

    /**
     * @param string $fileSystemClass
     * @return FileSystemFacadeBehavior
     */
    public function setFileSystemClass($fileSystemClass);

    /**
     * @param string $name
     * @param string $includePath
     * @param bool $vendor
     * @return FileSystemFacadeBehavior
     */
    public function addIncludePath($name, $includePath, $vendor = false);

    /**
     * @return string
     */
    public function getFileSystemClass();
}