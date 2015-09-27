<?php
/**
 * Class MapperService
 * @author Leiha Sellier <leiha.sellier@gmail.com>
 * @link   https://github.com/leiha
 * -
 */

namespace Cube\Poo\Mapper;

use Cube\Poo\Service\Injectable\InjectableBehavior;
use Cube\Poo\Single\SingleHelper;

class MapperService
	implements InjectableBehavior
{
	use SingleHelper, MapperServiceHelper {
		MapperServiceHelper::singleTo insteadOf SingleHelper;
	}
}