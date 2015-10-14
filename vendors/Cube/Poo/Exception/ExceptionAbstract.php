<?php
/**
 * Created by PhpStorm.
 * User: lia
 * Date: 18/09/15
 * Time: 11:30
 */

namespace Cube\Poo\Exception;

use Cube\Poo\Exception\Trace\Trace;
use Cube\Poo\Exception\Trace\TraceException;

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
     * @param string $msg
     * @param array $data
     */
    public function __construct($msg, array $data = array())
    {
        $this->data     = $data;
        $this->message  = $msg;
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
            return isset($data[$matches[1]])
                ? $data[$matches[1]]
                : $matches[0]
                ;
        };

        return preg_replace_callback('#:([[:alnum:]]+):#', $cb, $msg);
    }

    /**
     * @return array
     */
    public function getTraces()
	{
		$traces = $this->getTrace();
        foreach ($traces as &$trace) {
            $trace = new TraceException($trace);
		}
        return $traces;
    }



    public function render()
    {
        return '[ Exception ]'."\n\n"
            .$this->getLog()."\n"
            .' - '.$this->getFile().':'.$this->getLine()."\n"
            //.print_r($this->getTraces(), true)
            ."\n".$this->renderTraces()
        ;
    }

    public function renderTraces()
    {
        $bTraces = $this->getTraces();
        if(!count($bTraces)) {
            return;
        }

        $traces = '[ BackTraces ]'."\n";
        /** @var TraceException $trace */
        foreach($bTraces as $trace) {
            $traces .= "\n";
            $traces .= $trace->getFunctionName();
            if($file = $trace->getFile()) {
                $traces .= "\n - ".$file . ':' . $trace->getLine();
            }
            $traces .= "\n";

            $traces .= $this->renderArgsOfTrace($trace);
        }

        return $traces;
    }

    /**
     * @param TraceException $trace
     * @return string
     */
    public function renderArgsOfTrace(TraceException $trace)
    {
        if(!$args = $trace->getArgs()) {
            return '';
        }

        foreach($args as $name => &$arg)
        {
            if(!isset($arg['value'])) {
                $arg = ' $' . $name;
                continue;
            }

            $content = '';
            switch($arg['type']){
                case 'string':
                    $content = ' = "'.$arg['value'].'"';
                    break;
            }
            $arg = $arg['type'].' $'.$name.$content;
        }
        return "\t - ".implode("\n\t - ", $args)."\n";
    }
}
