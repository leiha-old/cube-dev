<?php
/**
 * Created by PhpStorm.
 * User: lia
 * Date: 12/10/15
 * Time: 23:45
 */

namespace Cube\Poo\Reflection\Doc;


abstract class Attribute
{
    /**
     * @return string
     */
    abstract protected function getName();

    /**
     * @return string
     */
    public function getPattern()
    {
        return ' ([[:alnum:]]+)';
    }

    /**
     * @param array $matches
     * @return array|void
     */
    public function getValues(array $matches)
    {
        return $matches[1][0];
    }

    /**
     * @param string $string
     * @return array
     */
    public function parse($string) {
        $pattern = '#@'.$this->getName().$this->getPattern().'#m';
        if (preg_match_all($pattern, $string, $matches, PREG_PATTERN_ORDER)) {
            return $this->getValues($matches);

        }
    }
}