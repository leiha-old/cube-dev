<?php

use Cube\Application\Application;

require '../../vendors/Cube/Cube.php';

$cube = Application::init(function(Application $cube) {
	$cube
		->autoLoader()
			->add('Application', realpath(__DIR__.'/../').'/')
	;
});


$rr = '';


