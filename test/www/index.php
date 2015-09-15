<?php

require '/studio/Cube/vendors/Cube/AutoLoader.php';

/** @var \Application\Main $App */
$App = Cube\BootStrap::init('Application\Main', realpath(__DIR__.'/..').'/');

//print_r(Cube\Dna\Loader\Loader::single()->getAll());

//$App->