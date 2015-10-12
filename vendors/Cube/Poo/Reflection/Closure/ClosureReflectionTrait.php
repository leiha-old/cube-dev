<?php
/**
 * Class ReflectionClosureTrait
 * @author Leiha Sellier <leiha.sellier@gmail.com>
 * @link   https://github.com/leiha
 * -
 */

namespace Cube\Poo\Reflection\Closure;

use Cube\Collection\Collection;

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
        $doc    = $this->extractDoc();

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
     * @return array
     */
    protected function extractDoc()
    {
        $pattern = '#@(param)(?: ([[:alnum:]]+)){0,1} \$([[:alnum:]]+)(?: (.*)){0,1}$#m';

        preg_match_all($pattern, $this->getDocComment(), $matches, PREG_PATTERN_ORDER);

        $args = array();
        foreach($matches[0] as $key => $match) {
            $args[$matches[3][$key]] = array(
                'type' => $matches[2][$key],
                'desc' => $matches[4][$key],
            );
        }

        return $args;
    }

    /**
     * @return array
     */
    public function extractDoc2()
    {
        $attributes = array(
            'param'      => '([[:alnum:]]+){0,1} \$([[:alnum:]]+)(?: (.*)){0,1}',
            'visibility' => '([[:alnum:]]+)'
        );

        foreach($attributes as $attribute => $pattern) {
            $pattern = '#@'.$attribute.' '.$pattern.'#m';
            if (preg_match_all($pattern, $this->getDocComment(), $matches, PREG_PATTERN_ORDER)) {
                foreach($matches[1] as $i => $type) {

                }
                $eeee = 'eeeeee';

            }
        }
        $ee = 'dddd';

    }

    /**
     * @return string
     */
    public function getSource()
    {
        $start   = $this->getStartLine() - 2;
        $end     = $this->getEndLine() - $start;
        $extract = implode('', array_slice(file($this->getFileName()), $start, $end));
        if(preg_match('/(\(.[^\)]*\)[[:space:]]*{(?:[^{}]+|(?R))*})/ms', $extract, $matches)) {
            return $matches[1];
        }
    }
}