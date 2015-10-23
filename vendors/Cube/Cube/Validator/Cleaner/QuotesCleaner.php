<?php

namespace Cube\Validator\Cleaner;

use Cube\Validator\Tool\FilterVarHelper;

class QuotesCleaner
    extends CleanerWrapper
{
    use FilterVarHelper;

    /**
     * @return int
     */
    protected function getType()
    {
        return FILTER_SANITIZE_MAGIC_QUOTES;
    }
}