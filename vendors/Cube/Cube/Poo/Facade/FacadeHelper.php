<?php
/**
 * Created by PhpStorm.
 * User: lia
 * Date: 23/10/15
 * Time: 02:04
 */

namespace Cube\Poo\Facade;


use Cube\Poo\Mapper\Mapper;

trait FacadeHelper
{
    /**
     * @var FacadeBehavior
     */
    protected $parentFacade;

    /**
     * @param string $className
     * @return $this
     */
    public function ____construct($className = '')
    {
        if($className) {
            Mapper::map(get_called_class(), $className);
        }
    }

    /**
     * @param FacadeBehavior $parentFacade
     * @return $this
     */
    final public function setParentFacade(FacadeBehavior $parentFacade)
    {
        $this->parentFacade = $parentFacade;
        return $this;
    }

    /**
     * @return FacadeBehavior
     */
    final public function end()
    {
        return $this->parentFacade;
    }
}