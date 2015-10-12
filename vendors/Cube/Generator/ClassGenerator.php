<?php

namespace Cube\Generator;


use Cube\Poo\Reflection\Reflection;

class ClassGenerator
{

    const CLASS_TYPE_interface = 'interface';
    const CLASS_TYPE_class     = 'class';
    const CLASS_TYPE_trait     = 'trait';

    const VISIBILITY_public    = 'public';
    const VISIBILITY_protected = 'protected';
    const VISIBILITY_private   = 'public';

    /**
     * @var string
     */
    protected $className;

    /**
     * @var string
     */
    protected $type = self::CLASS_TYPE_class;

    /**
     * @var string
     */
    protected $extends;

    /**
     * @var array
     */
    protected $implements = array();

    /**
     * @var array
     */
    protected $traits = array();

    /**
     * @var array
     */
    protected $methods = array();


    /**
     * @param string $className
     */
    public function __construct($className)
    {
        $this->className = $className;
    }

    /**
     * @param string $className
     * @return $this
     */
    public function setExtend($className)
    {
        $this->extends = $className;
        return $this;
    }

    /**
     * @param string $traitName
     * @return $this
     */
    public function addTrait($traitName)
    {
        $this->traits[] = $traitName;
        return $this;
    }

    /**
     * @param string $interfaceName
     * @return $this
     */
    public function addInterface($interfaceName)
    {
        $this->implements[] = $interfaceName;
        return $this;
    }

    /**
     * @param string    $methodName
     * @param \Closure  $closure
     * @param string    $visibility self::VISIBILITY_*
     * @return $this
     * @throws \Cube\Poo\Reflection\ReflectionException
     */
    public function addMethod(\Closure $closure, $visibility = self::VISIBILITY_public)
    {
        $f = Reflection::reflectFunction($closure);

        $zz = $f->extractDoc2();

        $this->methods[$methodName] =
             "\t".$f->getDocComment()
            ."\n\t".$visibility.' function '.$methodName.' '.$f->getSource()
        ;
        return $this;
    }
}