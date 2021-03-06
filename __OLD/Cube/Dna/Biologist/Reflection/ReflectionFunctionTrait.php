<?php
/**
 * Class ReflectionFunctionTrait
 * @author Leiha Sellier <leiha.sellier@gmail.com>
 * @link   https://github.com/leiha
 * -
 */

namespace OLD\Cube\Dna\Biologist\Reflection;

use Cube\Collection\Collection;

trait ReflectionFunctionTrait
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
     * @param array $values
     * @return array
     */
    public function getParametersExtended(array $values = array())
    {
        $params = array();
        $doc    = $this->extractDoc();

        (new Collection($this->getParameters()))->iterateWithCounter(
            function($counter, \ReflectionParameter &$value) use ($doc, &$params, $values)
            {
                $name = $value->getName();

                $params[$name] = array();
                if(isset($doc[$name])) {
                    $params[$name]['doc'] = $doc[$name];
                }

                $params[$name]['value'] = isset($values[$counter])
                    ? $values[$counter]
                    : ''
                    ;
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
}