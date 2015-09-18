<?php
/**
 * Class ReflectionClass
 * @author Leiha Sellier <leiha.sellier@gmail.com>
 * @link   https://github.com/leiha
 * -
 */

namespace OLD\Cube\Dna\Biologist\Reflection;

class ReflectionClass
    extends \ReflectionClass
{
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