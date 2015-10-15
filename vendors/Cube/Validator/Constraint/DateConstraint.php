<?php

namespace Cube\Validator\Constraint;

use Cube\Validator\Tool\PregMatchAbstract;

class DateConstraint
    extends PregMatchAbstract
{
    /**
     * @return string
     */
    protected function getPattern()
    {
        $pattern =
            '(?P<end>\,){0,1}' .

            '(?P<date1>' .
                '(?P<date1y>\d{4})\-(?P<date1m>\d{2})\-(?P<date1d>\d{2})' .
            ')' .

            '(?P<begin>\,){0,1}' .

            '(?P<date2>' .
                '(?P<date2y>\d{4})\-(?P<date2m>\d{2})\-(?P<date2d>\d{2})' .
            ')*'
        ;

        return '/^'.$pattern.'$/';
    }
}

