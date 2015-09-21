<?php

use Cube\Cube;

require '../../vendors/Cube/Cube.php';

Cube::addConfigurator('Cube\Cube')
    ->addMapping(Cube::MAPPING_EXCEPTION, 'AA')
    ;

$Cube = Cube::single();

$Cube->initException();
$Cube->initFileSystem();