<?php

namespace Cube\Poo\Exception;

use Cube\Poo\Mapper\Mappable\MappableHelper;

class Exception
    extends ExceptionWrapper
    implements ExceptionConstants
{
    use MappableHelper;

	/**
	 * @param \Exception $exception
	 * @return $this
	 */
	public static function forward(\Exception $exception) {
		$e = new static($exception->getMessage());
		return $e;
	}
}