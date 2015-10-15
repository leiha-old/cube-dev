<?php
/**
 * Created by PhpStorm.
 * User: lia
 * Date: 17/09/15
 * Time: 13:04
 */

namespace Cube\Validator\Cleaner;

use Cube\Poo\Exception\Exception;

class CleanerException
    extends Exception
{
    const TYPE_NOT_FOUND = 'Cleaner [ :cleanerName: ] not present !';
}