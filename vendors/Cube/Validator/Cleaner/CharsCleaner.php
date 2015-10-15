<?php

namespace Cube\Validator\Cleaner;

use Cube\Validator\Tool\FilterVarAbstract;

class CharsCleaner
    extends FilterVarAbstract
{
    /**
     * @return int
     */
    protected function getType()
    {
        return FILTER_SANITIZE_SPECIAL_CHARS;
    }
}