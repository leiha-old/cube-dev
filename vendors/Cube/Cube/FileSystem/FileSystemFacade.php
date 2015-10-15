<?php
/**
 * Created by PhpStorm.
 * User: lia
 * Date: 15/10/15
 * Time: 19:18
 */

namespace Cube\FileSystem;

use Cube\FileSystem\AutoLoader\AutoLoader;
use Cube\Poo\Facade\FacadeWrapper;

class FileSystemFacade
    extends FacadeWrapper
{
    /**
     * @var string
     */
    private $fileSystemClass = FileSystem::CLASS_name;

    /**
     * return ApplicationConfigurator
     */
    public function end() {
        parent::end();
    }

    /**
     * @param string $fileSystemClass
     * @return $this
     */
    public function setFileSystemClass($fileSystemClass)
    {
        $this->fileSystemClass = $fileSystemClass;
        return $this;
    }

    /**
     * @param string $name
     * @param string $includePath
     * @param bool $vendor
     * @return $this
     */
    public function addIncludePath($name, $includePath, $vendor = false)
    {
        AutoLoader::single()
            ->add($name, $includePath, $vendor)
            ;

        return $this;
    }

    /**
     * @return string
     */
    public function getFileSystemClass()
    {
        return $this->fileSystemClass;
    }
}