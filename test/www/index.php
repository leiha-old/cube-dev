<?php

use Cube\FileSystem\AutoLoader\AutoLoader;
use Cube\Poo\Mapper\Mapper;

require '../../vendors/Cube/Cube.php';

AutoLoader::add('Application', realpath(__DIR__.'/../').'/');

Mapper::init()
    ->initException()
    ->initFileSystem()
;

Mapper::setConfiguratorTo('ee', 'AA');