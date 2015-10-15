<?php
/**
 * Created by PhpStorm.
 * User: lia
 * Date: 15/10/15
 * Time: 15:09
 */

namespace Cube\Application;

use Cube\CubeFacade;
use Cube\FileSystem\FileSystemFacade;
use Cube\Http\HttpFacade;

class ApplicationFacade
    extends    CubeFacade
    implements ApplicationFacadeBehavior
{
    /**
     * @return HttpFacade
     */
    public function http() {
        return HttpFacade::single()
            ->setParentFacade($this)
            ;
    }

    /**
     * @return FileSystemFacade
     */
    public function fileSystem() {
        return FileSystemFacade::single($this)
            ->setParentFacade($this)
            ;
    }
}