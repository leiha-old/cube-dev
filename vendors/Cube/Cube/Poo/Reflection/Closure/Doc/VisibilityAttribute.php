<?php

namespace Cube\Poo\Reflection\Closure\Doc;

use Cube\Poo\Reflection\Doc\Attribute;

class VisibilityAttribute
    extends Attribute
{
    /**
     * @return string
     */
    protected function getName()
    {
        return 'visibility';
    }
}