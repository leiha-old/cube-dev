<?php

namespace Cube\FileSystem\AutoLoader;

use Cube\Poo\Error\Error;

class AutoLoaderError
    extends Error
{
    const FILE_404  = 'File [404] : [ :file: ]';

    const CLASS_404 = 'Class [404] : [ :className: ] :includePaths:';
}