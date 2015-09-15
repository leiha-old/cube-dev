<?php

namespace Cube\Exception;

use Cube\Collection\Collection;
use Cube\Dna\Biologist\Biologist;

abstract class Exception
    extends    \Exception
    implements ExceptionInterface
{
    /**
     * @param string $handler
     */
    public static function ____init($handler = 'Cube\Exception\Exception::____handler')
    {
        set_exception_handler($handler);
    }

    /**
     * @param Exception $exception
     */
    public static function ____handler(Exception $exception)
    {
        print($exception->render());
        exit;
    }

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
    abstract public function render();

    /**
     * @param string $msg
     * @param array $data
     * @param \Closure $callback
     */
    public function __construct($msg, array $data = array(), \Closure $callback = null)
    {
        $this->message  = $msg;
        $this->callback = $callback;
        $this->data     = $data;
    }

    /**
     * @return string
     */
    public function getLog()
    {
        $msg = $this->parser($this->message, $this->data);
        if($this->callback) {
            $msg .= call_user_func($this->callback, $this);
        }
        return $msg;
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
                    $reflector = Biologist::reflect($type, $function);
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
     * @param array  $data
     * @return string
     */
    public function parser($msg, array $data)
    {
        $cb = function($matches) use ($data) {
            return $data[$matches[1]] ? $data[$matches[1]] : $matches[0];
        };

        return preg_replace_callback('#:([[:alnum:]]+):#', $cb, $msg);
    }
}