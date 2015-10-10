<?php

namespace Cube\FileSystem;

use Cube\Poo\Service\Injectable\InjectableBehavior;

class FileSystem
    implements FileSystemConstants,
               InjectableBehavior
{
	use FileSystemServiceHelper;
}