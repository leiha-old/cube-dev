<?php
/**
 * Class CollectionSample
 * @author Leiha Sellier <leiha.sellier@gmail.com>
 * @link   https://github.com/leiha
 * -
 */

namespace Cube\Collection;

use Cube\Core\Mapper\MapperBehavior;

class CollectionSample
    implements CollectionInterface
{
    use CollectionBehavior;
    use MapperBehavior;

}