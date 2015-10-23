<?php

namespace Cube\FileSystem\AutoLoader;

use Cube\Poo\Error\ErrorWrapper;

class AutoLoaderError
    extends ErrorWrapper
{
    const FILE_404  = 'File [404] : [ :file: ]';

    const CLASS_404 = 'Class [404] : [ :className: ] :includePaths:';
}