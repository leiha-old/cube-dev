<?php

namespace Cube\FileSystem\AutoLoader;

use Cube\Poo\Exception\Exception;

class AutoLoaderException
    extends Exception
{
    const FILE_NOT_FOUND  = 'File [404] : [ :file: ]';

    const CLASS_NOT_FOUND = 'Class [404] : [ :className: ] :includePaths:';
}