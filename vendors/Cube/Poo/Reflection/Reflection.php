<?php
/**
 * Created by PhpStorm.
 * User: lia
 * Date: 18/09/15
 * Time: 14:32
 */

namespace Cube\Poo\Reflection;


use Cube\Poo\Mapper\Mappable\MappableConfigurator;
use Cube\Poo\Mapper\Mappable\MappableHelper;

class Reflection
    extends \ReflectionClass
{
    use MappableHelper;
    use ReflectionStatic;

    /**
     * @param MappableConfigurator $configurator
     * @return mixed
     */
    public function ____configureBehavior(MappableConfigurator $configurator)
    {
        // TODO: Implement ____configureBehavior() method.
    }

    /**
     * @var Array
     */
    private $traits = array();

    /**
     * @param bool $recursive
     * @return array
     */
    public function getTraitNames($recursive = true)
    {
        /**
         * @param array $traits
         */
        $getTraitNamesRecursive = function (array $traits) use ($recursive) {
            $this->traits = array_merge($this->traits, $traits);
            if($recursive) {
                array_walk($traits, function ($trait) {
                    $this->traits = array_merge($this->traits, (new self($trait))->getTraitNames());
                });
            }
        };

        $getTraitNamesRecursive(parent::getTraitNames());
        if($parentClassReflector = $this->getParentClass()) {
            $getTraitNamesRecursive($parentClassReflector->getTraitNames());
        }

        return $this->traits;
    }
}