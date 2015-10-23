<?php

namespace Cube\Poo\Error;

use Cube\Poo\Reflection\Closure\ClosureReflection;
use Cube\Poo\Reflection\Reflection;
use Cube\Poo\Reflection\ReflectionError;

class ErrorTrace
{
    /**
     * @var string
     */
    protected $functionName;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $file;

    /**
     * @var int
     */
    protected $line;

    /**
     * @var array
     */
    protected $args;

    /**
     * @var bool
     */
    protected $static = false;

    /**
     * @param array $trace
     */
    public function __construct(array $trace)
    {
        $this->setFileAndLine        ($trace);
        $this->setTypeAndFunctionName($trace);
        $this->setArgs               ($trace);
    }

    /**
     * @return string
     */
    public function getFile(){
        return $this->file;
    }

    /**
     * @return int
     */
    public function getLine(){
        return $this->line;
    }

    /**
     * @return string
     */
    public function getFunctionName(){
        return $this->functionName;
    }

    /**
     * @return string
     */
    public function getType(){
        return $this->type;
    }

    /**
     * @return array
     */
    public function getArgs(){
        return $this->args;
    }

    /**
     * @param array $trace
     */
    private function setArgs(array $trace)
    {
        if(!isset($trace['args'])) {
            return;
        }

        /**
         * @param array $trace
         */
        $paramsNormalizer = function (array $trace) {
            foreach ($trace['args'] as $i => &$arg) {
                $this->args[$i] = array(
                    'type'  => is_object($arg) ? get_class($arg) : gettype($arg),
                    'value' => $arg,
                    'doc'   => ''
                );
            }
        };

        if('anonymous' == $this->type) {
            $paramsNormalizer($trace);
        } else {
            try {
                /** @var ClosureReflection $reflector */
                $reflector  = Reflection::reflect($this->type, $this->functionName);
                $this->args = $reflector->getParametersExtended($trace['args']);
            } catch (ReflectionError $e) {
                $paramsNormalizer($trace);
            }
        }
    }

    /**
     * @param array $trace
     */
    private function setFileAndLine(array $trace)
    {
        if(isset($trace['file'])) {
            $this->file = $trace['file'];
            $this->line = $trace['line'];
        }
    }

    /**
     * @param $trace
     */
    private function setTypeAndFunctionName ($trace)
    {
        $type     = 'function';
        $function = $trace[$type];
        if(strpos($function, '{closure}') !== false) {
            $type = 'anonymous';
        }

        if(isset($trace['class'])) {
            $type         = 'method';
            $function     = ''.$trace['class'].'::'.$function;
            $this->static = $trace['type'] != '->';
        }
        $this->type         = $type;
        $this->functionName = $function;
    }
}