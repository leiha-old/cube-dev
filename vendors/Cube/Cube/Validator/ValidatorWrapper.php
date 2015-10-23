<?php
/**
 * Created by PhpStorm.
 * User: lia
 * Date: 23/10/15
 * Time: 04:26
 */

namespace Cube\Validator;

use Cube\Poo\Wrapper\Wrapper;

abstract class ValidatorWrapper
    extends    Wrapper
    implements ValidatorConstants
{
    use ValidatorHelper;
}