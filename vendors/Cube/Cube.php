<?php

namespace Cube;

include_once(__DIR__.'/FileSystem/AutoLoader/AutoLoader.php');

use Cube\Poo\Mapper\Mappable\MappableHelper;

abstract class Cube
    implements CubeConstants
{
    use MappableHelper;

	/**
	 * @param \Closure $cbOnStart
	 */
	public function __construct(\Closure $cbOnStart = null)
	{
		// Configure Cube
		if($cbOnStart) {
			$cbOnStart($this);
		}
	}
}