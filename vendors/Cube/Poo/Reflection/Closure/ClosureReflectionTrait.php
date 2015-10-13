<?php
/**
 * Class ReflectionClosureTrait
 * @author Leiha Sellier <leiha.sellier@gmail.com>
 * @link   https://github.com/leiha
 * -
 */

namespace Cube\Poo\Reflection\Closure;

use Cube\Collection\Collection;
use Cube\Poo\Reflection\Doc\Attribute;
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
     * @param array $values
     * @return array
     */
    public function getParametersExtended(array $values = array())
    {
        $params = array();
        $doc    = $this->extractDocAttribute('param');

        Collection::instance($this->getParameters())->iterateWithCounter(
            function($counter, \ReflectionParameter &$value) use ($doc, &$params, $values)
            {
                $name = $value->getName();

                $params[$name] = array();
                if(isset($doc[$name])) {
                    $params[$name]['doc'] = $doc[$name];
                }

	            $params[$name]['value'] = null;
	            if(isset($values[$counter])){

		            $value = $values[$counter];
		            $type  = gettype($value);
		            if('object' == $type) {
			            $type = get_class($value);
		            }

		            $params[$name]['value'] = array(
			            'content' => $value,
			            'type'    => $type
		            );
	            }
            }
        );

        return $params;
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
        if(preg_match('/((\(.[^\)]*\))[[:space:]]*{(?:[^{}]+|(?R))*})/ms', $extract, $matches))
        {
            $attributes = $this->extractDocAttributes('abstract', 'visibility', 'name');

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