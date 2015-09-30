<?php

use Cube\Cube;

require '../../vendors/Cube/Cube.php';

$cube = Cube::single(function(Cube $cube){
	$cube
		->autoLoader()
			->add('Application', realpath(__DIR__.'/../').'/')
	;
});

$cube
	->fileSystem()
		->parser()
			->parse()

;

$e = 'ee';

//	->mapper()
//		->setConfiguratorTo(Mapper::EXCEPTION, 'Cube\Collection\CollectionException')
//	;