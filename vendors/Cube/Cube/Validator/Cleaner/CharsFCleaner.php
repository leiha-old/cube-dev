<?php

namespace Cube\Validator\Cleaner;

use Cube\Validator\Tool\FilterVarHelper;

class CharsFCleaner
    extends CleanerWrapper
{
    use FilterVarHelper;

    /**
     * @return int
     */
    protected function getType()
    {
        return FILTER_SANITIZE_FULL_SPECIAL_CHARS;
    }
}