<?php
/**
 * Created by PhpStorm.
 * User: lia
 * Date: 15/10/15
 * Time: 22:51
 */

namespace Cube\Application;

use Cube\FileSystem\FileSystemFacade;
use Cube\Http\HttpFacade;
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
     * @return FileSystemFacade
     */
    public function fileSystem();
}