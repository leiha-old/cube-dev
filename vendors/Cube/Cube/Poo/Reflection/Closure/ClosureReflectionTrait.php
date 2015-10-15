<?php
/**
 * Class ReflectionClosureTrait
 * @author Leiha Sellier <leiha.sellier@gmail.com>
 * @link   https://github.com/leiha
 * -
 */

namespace Cube\Poo\Reflection\Closure;

use Cube\Collection\Collection;
use Cube\Poo\Reflection\Reflection;

trait ClosureReflectionTrait
{
    /**
     * @return array
     */
    abstract public function getParameters();

    /**
     * @return array
     */
    abstract public function getDocComment();

    /**
     * @return int
     */
    abstract public function getEndLine();

    /**
     * @return int
     */
    abstract public function getStartLine();

    /**
     * @return string
     */
    abstract public function getFileName();

    /**
     * @return string
     */
    abstract public function getName();

    /**
     * @param array $args
     * @return array
     */
    public function getParametersExtended(array $args = array())
    {

        $return = array();
        $doc    = $this->extractDocAttribute('param');
        $params = $this->getParameters();

        Collection::iterateArrayWithCounter(
            $params,
            function($end, \ReflectionParameter &$reflector, $counter)
                use ($doc, &$return, $args)
            {
                if(isset($args[$counter]))
                {
                    $arg  = $args[$counter];
                    $name = $reflector->getName();
                    $type = is_object($arg) ? get_class($arg) : gettype($arg);

                    $description = '';
                    if(isset($doc[$name])) {
                        $description = $doc[$name]['desc'];
                        if($type != $doc[$name]['type']) {
                            $type .= ' ( '.$doc[$name]['type'].' )';
                        }
                    }

                    $return[$name] = array(
                        'type'        => $type,
                        'value'       => $arg,
                        'description' => $description
                    );
	            }
            }
        );

        return $return;
    }

    /**
     * @param string $type
     * @return array
     */
    public function extractDocAttribute($type = 'param')
    {
        $params = $this->extractDocAttributes($type);
        return $params[$type];
    }

    /**
     * @return array
     */
    public function extractDocAttributes()
    {
        $doc        = array();
        $attributes = func_num_args() ? func_get_args() : Reflection::getListOfDocAttributes();
        foreach($attributes as $attribute) {
            $doc[$attribute] = Reflection::getDocAttribute($attribute, $this->getDocComment());
        }
        return $doc;
    }

    /**
     * @return string
     */
    public function getSource()
    {
        $start   = $this->getStartLine() - 2;
        $end     = $this->getEndLine() - $start;
        $extract = implode('', array_slice(file($this->getFileName()), $start, $end));
        if(preg_match('/((\([^\)]*\))[[:space:]]*{(?:[^{}]+|(?R))*})/ms', $extract, $matches))
        {
            $attributes = $this->extractDocAttributes('abstract', 'visibility', 'name', 'return');

            if(!isset($attributes['visibility'])) {
                $attributes['visibility'] = '';
            }

            if(!isset($attributes['name'])) {
                $attributes['name'] = $this->getName();
            }

            $source = $attributes['visibility'].' function '.$attributes['name'];
            if($attributes['abstract']) {
                $source = 'abstract '.$source.$matches[2].';';
            } else {
                $source .= ' '.$matches[1];
            }

            return "\t".$this->getDocComment()."\n\t".$source;
        }
    }
}