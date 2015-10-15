<?php
/**
 * Created by PhpStorm.
 * User: lia
 * Date: 15/10/15
 * Time: 23:38
 */

namespace Cube\Http;

use Cube\Application\ApplicationFacadeBehavior;
use Cube\Poo\Facade\FacadeBehavior;

interface HttpFacadeBehavior
    extends FacadeBehavior
{
    /**
     * @return ApplicationFacadeBehavior
     */
    public function end();
}