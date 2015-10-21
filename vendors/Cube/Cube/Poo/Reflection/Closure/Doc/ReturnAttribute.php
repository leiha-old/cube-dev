<?php
/**
 * Created by PhpStorm.
 * User: lia
 * Date: 15/10/15
 * Time: 00:43
 */

namespace Cube\Poo\Reflection\Closure\Doc;

use Cube\Poo\Reflection\Doc\Attribute;

class ReturnAttribute
    extends Attribute
{

    /**
     * @return string
     */
    protected function getName()
    {
        return 'return';
    }
}