<?php

namespace Cube\Validator\Cleaner;

use Cube\Validator\Tool\FilterVarAbstract;

class CharsFCleaner
    extends FilterVarAbstract
{
    /**
     * @return int
     */
    protected function getType()
    {
        return FILTER_SANITIZE_FULL_SPECIAL_CHARS;
    }
}