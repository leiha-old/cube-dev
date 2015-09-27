<?php
/**
 * Class CollectionService
 * @author Leiha Sellier <leiha.sellier@gmail.com>
 * @link   https://github.com/leiha
 * -
 */

namespace Cube\Collection;

use Cube\Poo\Service\Injectable\InjectableBehavior;
use Cube\Poo\Service\Injectable\InjectableHelper;

class CollectionService
	implements InjectableBehavior
{
	use InjectableHelper;
	use CollectionServiceHelper;
}