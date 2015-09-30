<?php
/**
 * Class ParserHelper
 * @author Leiha Sellier <leiha.sellier@gmail.com>
 * @link   https://github.com/leiha
 * -
 */

namespace Cube\FileSystem\Parser;

use Cache\Cube\FileSystem\AutoLoader\AutoLoaderException;
use Cube\FileSystem\AutoLoader\AutoLoader;
use Cube\FileSystem\FileSystem;
use Cube\Poo\Mapper\Mappable\MappableHelper;
use Cube\Poo\Mapper\Mapper;

trait ParserHelper
{
	use MappableHelper;

	/**
	 * @var array
	 */
	private $parts;

	private $fileSystem;

	public function __construct(FileSystem $fileSystem)
	{
		$this->fileSystem = $fileSystem;
		$this->parts      = array(
			'Constants'     => array(
				'found'    => false,
			),
			'Service'       => array(
				'found'    => false,
			),
			'ServiceHelper' => array(
				'found'    => false,
			),
			'Configurator'  => array(
				'found'    => false,
				'callback' => function ($className, $classConfigurator) {
					Mapper::single()->setConfiguratorTo($className, $classConfigurator);
				},
			),
			'Behavior'      => array(
				'found'    => false,
			),
			'Helper'        => array(
				'found'    => false,
			),
			'Interface'     => array(
				'found'    => false,
			),
			'Exception'     => array(
				'found'    => false,
			)
		);
	}

	public function parse() {

		$classes = array();
		$parts   = $this->parts;

		/**
		 * @param \DirectoryIterator $item
		 * @param $includePath
		 * @throws AutoLoaderException
		 */
		$parser = function(\DirectoryIterator $item, $includePath)
			use (&$parts, &$classes)
		{
			$name  = $item->getRealPath();
			$class = str_replace(DIRECTORY_SEPARATOR, '\\', substr($name, strlen($includePath), -4));
			if(AutoLoader::loadClass($class)) {
				$classes['______'][$class] = array();
			}

			// if files present like this : xxxx/Cube/Cube.php
			if(preg_match('/(.+\/(.[^\/]+)\/\2)\.php$/', $name, $matches)){
				$class = str_replace(DIRECTORY_SEPARATOR, '\\', substr($matches[1], strlen($includePath)));
				$this->ee($class, $parts, $classes);
			}
		};

		$this->fileSystem->iterateIncludePaths($parser);

		$ee = Mapper::single();
		$e = 'e';
	}

	/**
	 * @param string $class
	 * @param array  $parts
	 * @param array  $classes
	 * @throws AutoLoaderException
	 */
	protected function ee($class, array $parts, array &$classes = array()){
		foreach($parts as $part => &$partConfig) {
			$classService = $class.$part;

			$locations = array('Cache\\', 'Override\\', '');
			foreach($locations as $location) {
				$oClass = $location.$classService;
				if(!$partConfig['found'] && AutoLoader::loadClass($oClass)) {
					$classes[$class][$part] = $oClass;
					$partConfig['found'] = true;
					if(isset($partConfig['callback']) && is_callable($partConfig['callback'])) {
						$partConfig['callback']($class, $classService);
					}
				}
			}
		}
	}
}