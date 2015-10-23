<?php
/**
 * Created by PhpStorm.
 * User: lia
 * Date: 15/10/15
 * Time: 21:00
 */

namespace Cube\Poo\Facade\Drivable;

use Cube\Poo\Facade\FacadeBehavior;

interface DrivableBehavior
{
    /**
     * @return FacadeBehavior
     */
    public static function newFacade();

    /**
     * @return FacadeBehavior
     */
    public function getFacade();
}