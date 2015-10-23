<?php

namespace Cube\Generator\ClassGenerator;

use Cube\Generator\Generator;
use Cube\Poo\Reflection\Reflection;

class ClassGenerator
{
    /**
     * @var string
     */
    protected $className;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $extends;

    /**
     * @var string
     */
    protected $namespace;

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
     * @param string $type      Generator::TYPE_*
     */
    public function __construct($className, $type = Generator::TYPE_class)
    {
        $this->type      = $type;
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
     * @param string $namespace
     * @return $this
     */
    public function setNameSpace($namespace)
    {
        $this->namespace = $namespace;
        return $this;
    }

    /**
     * @param string $traitName
     * @return $this
     */
    public function addTrait($traitName)
    {
        $this->traits = array_merge($this->traits, $traitName);;
        return $this;
    }

    /**
     * @param array|string $interfaceNames
     * @return $this
     */
    public function addInterface($interfaceNames)
    {
        $this->implements = array_merge($this->implements, $interfaceNames);
        return $this;
    }

    /**
     * @param \Closure $closure
     * @param array $data
     * @return $this
     * @throws \Cube\Poo\Reflection\ReflectionError
     */
    public function addMethod(\Closure $closure, array $data = array())
    {
        $f = Reflection::reflectFunction($closure);

        $source = $f->getSource();
        if(count($data)) {
            $source = preg_replace_callback('/\$\$([[:alnum:]_]+)/',
                function($matches) use ($data){
                    return isset($data[$matches[1]])
                        ? $data[$matches[1]]
                        : $matches[0]
                        ;
                }
                , $source
            );
        }
        $this->methods[] = $source;
        return $this;
    }

    /**
     * @return string
     */
    public function render()
    {
        $namespace = '';
        if(count($this->namespace)) {
            $namespace = "\n".'namespace '.$this->namespace.";\n\n";
        }

        $className = $this->type.' '.$this->className;

        $extends = '';
        if(count($this->extends)) {
            $extends = "\n\t".'extends '.$this->extends;
        }

        $implements = '';
        if(count($this->implements)) {
            $implements = "\n\t".'implements '.implode(', ', $this->implements);
        }

        $traits = '';
        if(count($this->traits)) {
            $traits = "\t".'use '.implode(";\n\tuse ", $this->traits).";\n\n";
        }

        $methods = implode("\n\n", $this->methods);

        return
            $namespace
            .$className
            .$extends
            .$implements
            ."\n{\n$traits.$methods\n}"
            ;
    }

}