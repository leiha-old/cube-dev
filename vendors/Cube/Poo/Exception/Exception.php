<?php

namespace Cube\Poo\Exception;

use Cube\Poo\Mapper\Mappable\MappableHelper;

class Exception
    extends ExceptionWrapper
    implements ExceptionConstants
{
    use MappableHelper;

}