<?php
/**
 * Created by PhpStorm.
 * User: lia
 * Date: 15/10/15
 * Time: 23:38
 */

namespace Cube\Http;

use Cube\Application\ApplicationBehavior;
use Cube\Http\Router\RouterBehavior;
use Cube\Poo\Facade\FacadeBehavior;

interface HttpBehavior
    extends FacadeBehavior
{
    /**
     * @param string $className
     * @return RouterBehavior
     */
    public function router($className = Http::Router);

    /**
     * @return ApplicationBehavior
     */
    public function end();


}