<?php

namespace Cube\Poo\Exception;

use Cube\Poo\Mapper\MapperConfigurator;
use Cube\Poo\Mapper\MapperFacade;

class Exception
    extends ExceptionAbstract
    implements ExceptionConstants
{
    use MapperFacade;

    /**
     * @param MapperConfigurator $configurator
     * @return mixed
     */
    public function ____configureBehavior(MapperConfigurator $configurator)
    {
        // TODO: Implement ____configureBehavior() method.
    }
}