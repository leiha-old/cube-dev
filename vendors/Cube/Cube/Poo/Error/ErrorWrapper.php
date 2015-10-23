<?php
/**
 * Created by PhpStorm.
 * User: lia
 * Date: 18/09/15
 * Time: 11:30
 */

namespace Cube\Poo\Error;

use Cube\Poo\Mapper\Mappable\MappableHelper;

abstract class ErrorWrapper
    extends \Exception
{
    use MappableHelper;

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
//            if(!isset($row[$matches[1]])) {
//                throw new \Error("The key [ $matches[1] ] is not present in row ! ");
//            }


            if(isset($data[$matches[1]])) {
                if(is_array($data[$matches[1]])) {
                    $data[$matches[1]] = "\n - \n". implode(" - \n", $data[$matches[1]]);
                }
            }



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
            $trace = new ErrorTrace($trace);
		}
        return $traces;
    }

    /**
     * @return string
     */
    public function render()
    {
        return '[ '.get_called_class().' ]'."\n\n"
            .$this->getLog()."\n"
            .' - '.$this->getFile().':'.$this->getLine()."\n"
            ."\n".$this->renderTraces()
        ;
    }

    /**
     * @return string
     */
    private function renderTraces()
    {
        $bTraces = $this->getTraces();
        if(!count($bTraces)) {
            return '';
        }

        $traces = '[ BackTraces ]'."\n";
        /** @var ErrorTrace $trace */
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
     * @param ErrorTrace $trace
     * @return string
     */
    private function renderArgsOfTrace(ErrorTrace $trace)
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
