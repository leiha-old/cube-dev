<?php

require '../../vendors/Cube/Cube.php';

$Cube = Cube\Cube::single();
$Cube->__construct(function(\Cube\Configurator\Configurator $configurator){
    $configurator->
});

$Cube->initException();
$Cube->initFileSystem();


