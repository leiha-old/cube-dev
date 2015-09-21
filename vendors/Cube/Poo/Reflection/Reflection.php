<?php
/**
 * Created by PhpStorm.
 * User: lia
 * Date: 18/09/15
 * Time: 14:32
 */

namespace Cube\Poo\Reflection;

use Cube\Poo\Mapper\MapperConfigurator;
use Cube\Poo\Mapper\MapperFacade;

class Reflection
    extends \ReflectionClass
{
    use MapperFacade;
    use ReflectionStatic;

    /**
     * @param MapperConfigurator $configurator
     * @return mixed
     */
    public function ____configureBehavior(MapperConfigurator $configurator)
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