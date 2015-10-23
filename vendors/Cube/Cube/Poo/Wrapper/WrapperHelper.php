<?php
/**
 * Created by PhpStorm.
 * User: lia
 * Date: 23/10/15
 * Time: 01:41
 */

namespace Cube\Poo\Wrapper;

use Cube\Poo\Mapper\Mapper;

trait WrapperHelper
{
    /**
     * @var string
     */
    private $wrappedClassName;

    /**
     * @var array
     */
    private $wrappedArgs = array();

    /**
     * @var mixed
     */
    private $wrappedObject;

    /**
     * @return mixed
     */
    public function getWrapped()
    {
        if(!$this->wrappedObject) {
            $this->wrappedObject = Mapper::instanceTo($this->wrappedClassName, $this->wrappedArgs);
        }

        return $this->wrappedObject;
    }
}