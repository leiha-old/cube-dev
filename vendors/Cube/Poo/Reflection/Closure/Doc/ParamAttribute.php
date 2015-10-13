<?php

namespace Cube\Poo\Reflection\Closure\Doc;

use Cube\Poo\Reflection\Doc\Attribute;

class ParamAttribute
    extends Attribute
{
    /**
     * @return string
     */
    protected function getName()
    {
        return 'param';
    }

    /**
     * @return string
     */
    public function getPattern()
    {
        return ' ([[:alnum:]]+){0,1} \$([[:alnum:]]+)(?: (.*)){0,1}';
    }

    /**
     * @param array $matches
     * @return array
     */
    public function getValues(array $matches)
    {
        $args = array();
        foreach($matches[0] as $key => $match) {
            $args[$matches[2][$key]] = array(
                'type' => $matches[1][$key],
                'desc' => $matches[3][$key],
            );
        }
        return $args;
    }
}