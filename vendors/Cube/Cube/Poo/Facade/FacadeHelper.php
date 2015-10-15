<?php
/**
 * Created by PhpStorm.
 * User: lia
 * Date: 15/10/15
 * Time: 20:59
 */

namespace Cube\Poo\Facade;

trait FacadeHelper
{
    /**
     * @var Facade|FacadeBehavior
     */
    private $parentFacade;

    /**
     * @param Facade|FacadeBehavior $parentFacade
     * @return $this
     */
    public function setParentFacade(FacadeBehavior $parentFacade)
    {
        $this->parentFacade = $parentFacade;
        return $this;
    }

    /**
     * @return Facade|FacadeBehavior
     */
    public function end() {
        return $this->parentFacade;
    }
}