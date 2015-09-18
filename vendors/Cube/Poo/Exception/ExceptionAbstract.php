<?php
/**
 * Created by PhpStorm.
 * User: lia
 * Date: 18/09/15
 * Time: 11:30
 */

namespace Cube\Poo\Exception;

use Cube\Collection\Collection;
use Cube\Poo\Reflection\Reflection;

abstract class ExceptionAbstract
    extends \Exception
{
    /**
     * @var \Closure
     */
    protected $callback;

    /**
     * @var array
     */
    protected $data;

    /**
     * @return string
     */
    public function render()
    {
        $ret = ''
            .$this->getLog()."\n"
            .$this->getFile().' : '.$this->getLine()."\n"
            .print_r($this->getTraces(), true)
            ;

        echo $ret;
    }

    /**
     * @param string $msg
     * @param array $data
     */
    public function __construct($msg, array $data = array())
    {
        $this->message = $msg;
        $this->data = $data;
    }

    /**
     * @return string
     */
    public function getLog()
    {
        $msg = $this->parser($this->message, $this->data);
        return $msg;
    }

    /**
     * @param string $file
     * @param int $line
     * @return $this
     */
    public function setFile($file, $line)
    {
        $this->file = $file;
        $this->line = $line;
        return $this;
    }

    /**
     * @param string $msg
     * @param array $data
     * @return string
     */
    public function parser($msg, array $data)
    {
        $cb = function ($matches) use ($data) {
            return $data[$matches[1]] ? $data[$matches[1]] : $matches[0];
        };

        return preg_replace_callback('#:([[:alnum:]]+):#', $cb, $msg);
    }

    /**
     * @return array
     */
    public function getTraces()
    {
        $autoload = false;
        $traces   = $this->getTrace();

        $cbFilter = function(&$trace) use (&$autoload)
        {
            $type     = 'function';
            $function = $trace['function'];
            if(isset($trace['class'])) {
                $type     = 'method';
                $function = '\\'.$trace['class'].'::'.$function;
            }

            if(isset($trace['args'])) {
                $reflector = Reflection::reflect($type, $function);
                $trace['args'] = $reflector->getParametersExtended($trace['args']);
            }

            if($autoload
                && 'spl_autoload_call' == $function)
            {
                $this->file = $trace['file'];
                $this->line = $trace['line'];
                #return false;
            }
            elseif('Cube\AutoLoader::autoload' == $function) {
                $autoload = true;
            }
            return true;
        };

        return Collection::instance($traces)->filter($cbFilter);
    }
}
