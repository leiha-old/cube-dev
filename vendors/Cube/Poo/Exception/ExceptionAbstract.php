<?php
/**
 * Created by PhpStorm.
 * User: lia
 * Date: 18/09/15
 * Time: 11:30
 */

namespace Cube\Poo\Exception;

use Cube\Collection\Collection;
use Cube\Poo\Reflection\Closure\ClosureReflection;
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
	    $ret = '[ Exception ]'."\n\n"
            .$this->getLog()."\n"
            .' - '.$this->getFile().':'.$this->getLine()."\n"
            //.print_r($this->getTraces(), true)
			."\n".$this->renderTraces()
            ;

        echo $ret;
    }

	public function renderTraces()
	{
		$bTraces = $this->getTraces();
		if(!count($bTraces)) {
			return;
		}

		$traces = '[ BackTraces ]'."\n";
		foreach($bTraces as $trace) {
			$traces .= "\n";
			if(isset($trace['class'])) {
				$traces .= $trace['class'].$trace['type'].$trace['function'];
			} else {
				$traces .= $trace['function'];
			}

			if(isset($trace['file'])) {
				$traces .= "\n - ".$trace['file'] . ':' . $trace['line'];
			}
			$traces .= "\n";

			$traces .= $this->renderArgsTrace($trace);
		}

		return $traces;
	}

	/**
	 * @param array $trace
	 * @return string
	 */
	public function renderArgsTrace(array $trace)
	{
		if(count($trace['args'])) {
			$args = array();
			foreach($trace['args'] as $name => $arg) {
				if($arg['value']) {
					$content = '';
					switch($arg['value']['type']){
						case 'string':
							$content = ' = "'.$arg['value']['content'].'"';
							break;
					}

					$args[$name] = $arg['value']['type'].' $'.$name.$content;
				} else {
					$args[$name] = ' $'.$name;
				}
			}
			return "\t - ".implode("\n\t - ", $args)."\n";
		}
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
        $autoload = false;
        $traces   = $this->getTrace();

        $cbFilter = function(&$trace) use (&$autoload)
        {
	        if(strpos($trace['function'], '{closure}') > -1) {
		        $values = array();
				foreach($trace['args'] as $value) {
					$type  = gettype($value);
					if('object' == $type) {
						$type = get_class($value);
					}

					$values[]['value'] = array('content' => $value, 'type' => $type);
				}
		        $trace['args'] = $values;
	        } else {
		        $type     = 'function';
		        $function = $trace['function'];
		        if(isset($trace['class'])) {
			        $type     = 'method';
			        $function = '\\'.$trace['class'].'::'.$function;
		        }

		        if(isset($trace['args'])) {
			        /** @var ClosureReflection $reflector */
			        if($reflector = Reflection::reflect($type, $function)) {
				        $trace['args'] = $reflector->getParametersExtended($trace['args']);
			        }
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
	        }
            return true;
        };

        return Collection::instance($traces)->filter($cbFilter);
    }
}
