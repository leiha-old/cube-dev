<?php

namespace Cube\Validator\Cleaner;

use Cube\Validator\Tool\FilterVarHelper;

class CharsCleaner
    extends CleanerWrapper
{
    use FilterVarHelper;
    /**
     * @return int
     */
    protected function getType()
    {
        return FILTER_SANITIZE_SPECIAL_CHARS;
    }
}