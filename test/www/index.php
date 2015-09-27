<?php

use Cube\Cube;

require '../../vendors/Cube/Cube.php';

$cube = Cube::single(function(Cube $cube){
	$cube
		->autoLoader()
			//->add('Application', realpath(__DIR__.'/../').'/')
	;
});


$classes = array();
$cube
	->fileSystem()
		->iterateIncludePaths(function(\DirectoryIterator $item, $includePath) use (&$classes) {

			$name = $item->getRealPath();

			if(preg_match('/(.+\/(.[^\/]+)\/\2)\.php$/', $name, $matches)){
				$class = str_replace('/', '\\', substr($matches[1], strlen($includePath)));

				$parts = array('Service', 'dsdsqsqdd');

				foreach($parts as $part) {
					$classService = $class.$part;
					if(\Cube\FileSystem\AutoLoader\AutoLoader::loadClass($classService)) {
						$classes[$class][$part] = $classService;
					}
				}








			}
		})
;

$e = 'ee';

//	->mapper()
//		->setConfiguratorTo(Mapper::EXCEPTION, 'Cube\Collection\CollectionException')
//	;