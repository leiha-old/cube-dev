<?php

namespace Cube\Poo\Error;

use Cube\Poo\Mapper\Mappable\MappableHelper;

class Error
    extends ErrorWrapper
    implements ErrorConstants
{
    use MappableHelper;

	/**
	 * @param \Exception $error
	 * @return $this
	 */
	public static function forward(\Exception $error) {
		$e = new static($error->getMessage());
		return $e;
	}
}