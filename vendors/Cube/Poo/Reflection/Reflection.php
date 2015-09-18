<?php
/**
 * Created by PhpStorm.
 * User: lia
 * Date: 18/09/15
 * Time: 14:32
 */

namespace Cube\Poo\Reflection;

class Reflection
    extends \ReflectionClass
{
    use ReflectionStatic;

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