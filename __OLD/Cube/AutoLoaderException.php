<?php

namespace Cube;

use Cube\Cube\CubeException;

class AutoLoaderException
    extends CubeException
{
    const FILE_NOT_FOUND  = 'File [404] : [ :file: ]';

    const CLASS_NOT_FOUND = 'Class [404] : [ :className: ] :includePaths:';
}