<?php

namespace Cube\FileSystem;

class FileSystem
    extends FileSystemWrapper
{
    /**
     * @param array $includePaths
     */
    public function __construct(array $includePaths) {
        parent::__construct($includePaths, $this);
    }
}