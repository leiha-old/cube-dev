<?php
/**
 * Class InjectableHelper
 * @author Leiha Sellier <leiha.sellier@gmail.com>
 * @link   https://github.com/leiha
 * -
 */

namespace Cube\Poo\Service\Injectable;

use Cube\Poo\Service\Service;
use Cube\Poo\Single\SingleHelper;

trait InjectableHelper
{
	use SingleHelper;

	/**
	 * @return Service
	 */
	public static function single()
	{
		return static::singleTo(get_called_class().'Service', func_get_args());
	}
}