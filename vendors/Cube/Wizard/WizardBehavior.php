<?php
/**
 * Class WizardBehavior
 * @author Leiha Sellier <leiha.sellier@gmail.com>
 * @link   https://github.com/leiha
 * -
 */

namespace Cube\Wizard;

use Cube\Collection\CollectionBehavior;
use Cube\Core\Instance\InstanceBehavior;

trait WizardBehavior
{
    use InstanceBehavior {
        instance as private;
    }

    use CollectionBehavior {

    }

    public static function extractClasses()
    {

    }
}