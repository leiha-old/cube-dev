<?php

namespace Cube\Validator\Cleaner;

use Cube\Validator\Tool\FilterVarAbstract;

class EmailCleaner
    extends FilterVarAbstract
{
    /**
     * @return int
     */
    protected function getType()
    {
        return FILTER_SANITIZE_EMAIL;
    }
}