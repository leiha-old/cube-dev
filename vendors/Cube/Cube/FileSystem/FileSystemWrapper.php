<?php
/**
 * Created by PhpStorm.
 * User: lia
 * Date: 15/10/15
 * Time: 21:48
 */

namespace Cube\FileSystem;

use Cube\Poo\Mapper\Mappable\MappableHelper;
use Cube\Poo\Wrapper\Wrapper;

abstract class FileSystemWrapper
    extends    Wrapper
    implements FileSystemBehavior, FileSystemConstants
{
    use FileSystemHelper;
    use MappableHelper;

    /**
     * @param array $includePaths
     * @param object $wrapped
     * @param array $args
     */
    public function __construct(array $includePaths, $wrapped, $args = array()) {
        parent::__construct($wrapped, $args);
        $this->includePaths = $includePaths;
    }
}