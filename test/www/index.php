<?php

use Cube\Cube;

require '../../vendors/Cube/Cube.php';

$cube = Cube::single(function(Cube $cube){
	$cube
		->autoLoader()
			->add('Application', realpath(__DIR__.'/../').'/')
	;
});


$classes = array();
$cube
	->fileSystem()
		->iterateIncludePaths(function(\DirectoryIterator $item, $includePath) use (&$classes) {

			$name = $item->getRealPath();

			$class = str_replace(DIRECTORY_SEPARATOR, '\\', substr($name, strlen($includePath), -4));
			if(\Cube\FileSystem\AutoLoader\AutoLoader::loadClass($class)) {
				$classes['______'][$class] = array();
			}

			if(preg_match('/(.+\/(.[^\/]+)\/\2)\.php$/', $name, $matches)){
				$class = str_replace(DIRECTORY_SEPARATOR, '\\', substr($matches[1], strlen($includePath)));

				$cbOverride = function($class, array &$parts, array &$classes = array()){
					foreach($parts as $part => &$found) {
						$classService = $class.$part;

						$locations = array('Cache\\', 'Override\\', '');
						foreach($locations as $location) {
							$oClass = $location.$classService;
							if(!$found && \Cube\FileSystem\AutoLoader\AutoLoader::loadClass($oClass)) {
								$classes[$class][$part] = $oClass;
								$found = true;
							}
						}
					}
				};

				$parts = array(
					'Constants'     => false,
					'Service'       => false,
					'Configurator'  => false,
					'Behavior'      => false,
					'Helper'        => false,
					'Interface'     => false,
					'Exception'     => false,
				);

				$cbOverride($class, $parts, $classes);
			}
		})
;

$e = 'ee';

//	->mapper()
//		->setConfiguratorTo(Mapper::EXCEPTION, 'Cube\Collection\CollectionException')
//	;