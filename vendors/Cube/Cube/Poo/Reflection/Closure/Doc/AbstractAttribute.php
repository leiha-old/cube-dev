<?php

namespace Cube\Poo\Reflection\Closure\Doc;

use Cube\Poo\Reflection\Doc\Attribute;

class AbstractAttribute
    extends Attribute
{
    /**
     * @return string
     */
    protected function getName()
    {
        return 'abstract';
    }

    /**
     * @return string
     */
    public function getPattern()
    {
        return '';
    }

    /**
     * @param array $matches
     * @return array|void
     */
    public function getValues(array $matches)
    {
        return true;
    }


}