<?php
/**
 * Created by PhpStorm.
 * User: lia
 * Date: 15/10/15
 * Time: 22:51
 */

namespace Cube\Application;

use Cube\FileSystem\FileSystemBehavior;
use Cube\Http\HttpBehavior;
use Cube\Poo\Facade\FacadeBehavior;

interface ApplicationBehavior
    extends FacadeBehavior
{
    /**
     * @return HttpBehavior
     */
    public function http();

    /**
     * @return FileSystemBehavior
     */
    public function fileSystem();
}