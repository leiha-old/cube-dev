<?php
/**
 * Created by PhpStorm.
 * User: lia
 * Date: 15/10/15
 * Time: 22:51
 */

namespace Cube\Application;

use Cube\FileSystem\FileSystemFacadeBehavior;
use Cube\Http\HttpFacadeBehavior;
use Cube\Poo\Facade\FacadeBehavior;

interface ApplicationFacadeBehavior
    extends FacadeBehavior
{
    /**
     * @return HttpFacadeBehavior
     */
    public function http();

    /**
     * @return FileSystemFacadeBehavior
     */
    public function fileSystem();
}