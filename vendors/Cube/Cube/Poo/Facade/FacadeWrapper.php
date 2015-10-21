<?php
/**
 * Created by PhpStorm.
 * User: lia
 * Date: 15/10/15
 * Time: 19:37
 */

namespace Cube\Poo\Facade;

use Cube\Poo\Mapper\Mappable\MappableHelper;

abstract class FacadeWrapper
    implements FacadeBehavior
{
    use FacadeHelper;
    use MappableHelper;
}