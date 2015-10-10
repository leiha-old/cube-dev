<?php
/**
 * Class Mapper
 * @author Leiha Sellier <leiha.sellier@gmail.com>
 * @link   https://github.com/leiha
 * -
 */

namespace Cube\Poo\Mapper;

use Cube\Poo\Service\Injectable\Injectable;
use Cube\Poo\Single\SingleHelper;

class Mapper
    extends Injectable
    implements MapperConstants
{
	use SingleHelper;

	/**
	 * @return MapperService
	 */
	public static function single()
	{
		return SingleHelper::singleTo(get_called_class().'Service', func_get_args());
	}
}