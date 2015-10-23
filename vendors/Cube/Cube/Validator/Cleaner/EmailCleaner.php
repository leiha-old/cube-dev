<?php

namespace Cube\Validator\Cleaner;

use Cube\Validator\Tool\FilterVarHelper;

class EmailCleaner
    extends CleanerWrapper
{
    use FilterVarHelper;

    /**
     * @return int
     */
    protected function getType()
    {
        return FILTER_SANITIZE_EMAIL;
    }
}