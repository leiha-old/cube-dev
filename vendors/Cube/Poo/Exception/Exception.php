<?php

namespace Cube\Poo\Exception;

use Cube\Poo\Mapper\Mappable\MappableBehavior;
use Cube\Poo\Mapper\Mappable\MappableHelper;

class Exception
    extends ExceptionAbstract
    implements ExceptionConstants
{
    use MappableHelper;

	/**
	 * @param MappableBehavior $configurator
	 * @return mixed
	 */
	public function ____configureBehavior(MappableBehavior $configurator)
	{
		// TODO: Implement ____configureBehavior() method.
	}
}