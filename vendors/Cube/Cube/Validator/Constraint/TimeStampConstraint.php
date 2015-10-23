<?php

namespace Cube\Validator\Constraint;

use Cube\Validator\Tool\PregMatchHelper;

class TimeStampConstraint
    extends ConstraintWrapper
{
    use PregMatchHelper;

    public function __construct() {
        $this->setOnSuccess(function(&$value, $matches){

            $arr = array($matches['time1']);

            // Enable BETWEEN Clause
            if(!empty($matches['time2'])) {
                $arr[] = 'BETWEEN';
                $arr[] = $matches['time2'];
            }
            // Enable INFERIOR OR EQUAL Clause
            elseif (!empty($matches['end'])) {
                $arr[] = '<=';
            }
            // Enable SUPERIOR OR EQUAL Clause
            elseif (!empty($matches['begin'])) {
                $arr[] = '>=';
            }

            $value = $arr;
        });
    }

    /**
     * @return string
     */
    protected function getPattern()
    {
        $pattern =
            '(?P<end>\,){0,1}' .

            '(?P<time1>\d{10})' .

            '(?P<begin>\,){0,1}' .

            '(?P<time2>\d+){0,1}'
        ;

        return '/^'.$pattern.'$/';
    }
}