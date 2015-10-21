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
use Cube\Poo\Reflection\Doc\Attribute;

class Reflection
    extends \ReflectionClass
{
    use MappableHelper;
    use ReflectionStatic;

    /**
     * @var array
     */
    private static $docAttributes = array(
        'param'      => 'Cube\Poo\Reflection\Closure\Doc\ParamAttribute',
        'visibility' => 'Cube\Poo\Reflection\Closure\Doc\VisibilityAttribute',
        'name'       => 'Cube\Poo\Reflection\Closure\Doc\NameAttribute',
        'abstract'   => 'Cube\Poo\Reflection\Closure\Doc\AbstractAttribute',
        'return'     => 'Cube\Poo\Reflection\Closure\Doc\ReturnAttribute',
    );

    /**
     * @param string $name
     * @return Attribute
     */
    public static function getDocAttribute($name, $string) {
        /** @var Attribute $parser */
        $parser = new self::$docAttributes[$name]();
        return $parser->parse($string);
    }

    /**
     * @return array
     */
    public static function getListOfDocAttributes() {
        return array_keys(self::$docAttributes);
    }

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