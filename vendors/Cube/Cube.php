<?php

namespace Cube;

include_once(__DIR__.'/FileSystem/AutoLoader/AutoLoader.php');

use Cube\FileSystem\AutoLoader\AutoLoader;
use Cube\FileSystem\FileSystem;
use Cube\FileSystem\FileSystemService;
use Cube\Poo\Exception\Exception;
use Cube\Poo\Mapper\Mappable\MappableBehavior;
use Cube\Poo\Mapper\Mappable\MappableHelper;
use Cube\Poo\Mapper\Mapper;
use Cube\Poo\Mapper\MapperService;
use Cube\Poo\Single\SingleHelper;

abstract class Cube
    implements CubeConstants
{
    use MappableHelper;

	/**
	 * @var FileSystemService
	 */
	private $fileSystem;

	/**
	 * @var AutoLoader
	 */
	private $autoLoader;

	/**
	 * @var Mapper
	 */
	private static $_mapper;

	/**
	 * @param \Closure|null $cbOnStart
	 * @return static
	 */
	public static function init(\Closure $cbOnStart = null) {
		self::mapper();
		return self::single($cbOnStart);
	}

	/**
	 * @param \Closure $cbOnStart
	 */
	public function __construct(\Closure $cbOnStart = null)
	{
		// Configure Cube
		if($cbOnStart) {
			$cbOnStart($this);
		}

		$this->fileSystem()->parser()->parse();
	}

	/**
	 * @return FileSystem
	 */
	public function fileSystem()
	{
		if(!$this->fileSystem) {
			$this->fileSystem = FileSystem::single(AutoLoader::getListOfIncludeFiles());
		}
		return $this->fileSystem;
	}

	/**
	 * @return AutoLoader
	 */
	public function autoLoader()
	{
		return AutoLoader::single();
	}
}