<?php

namespace Cube\Poo\Reflection\Closure\Doc;

use Cube\Poo\Reflection\Doc\Attribute;

class NameAttribute
    extends Attribute
{
    /**
     * @return string
     */
    protected function getName()
    {
        return 'name';
    }


}