<?php

namespace Cube\FileSystem\AutoLoader;

use Cube\Poo\Exception\Exception;

class AutoLoaderException
    extends Exception
{
    const FILE_404  = 'File [404] : [ :file: ]';

    const CLASS_404 = 'Class [404] : [ :className: ] :includePaths:';
}