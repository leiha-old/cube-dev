<?php

namespace Cube;

include_once(__DIR__.'/FileSystem/AutoLoader/AutoLoader.php');

use Cube\FileSystem\AutoLoader\AutoLoader;
use Cube\FileSystem\FileSystem;
use Cube\FileSystem\FileSystemService;
use Cube\Poo\Exception\Exception;
use Cube\Poo\Mapper\Mappable\MappableBehavior;
use Cube\Poo\Mapper\Mapper;
use Cube\Poo\Mapper\MapperService;
use Cube\Poo\Single\SingleHelper;

class Cube
    implements CubeConstants
{
    use SingleHelper;

	/**
	 * @var FileSystemService
	 */
	private $fileSystem;


	/**
	 * @var AutoLoader
	 */
	private $autoLoader;

	/**
	 * @var MapperService
	 */
	private $mapper;

	/**
	 * @param MappableBehavior $configurator
	 * @return mixed
	 */
	public function ____configureBehavior(MappableBehavior $configurator)
	{
		// TODO: Implement ____configureBehavior() method.
	}

	/**
	 * @param \Closure $cbOnStart
	 */
	public function __construct(\Closure $cbOnStart = null)
	{
		// Init Mapper
		$this->mapper();

		// Configure Cube
		if($cbOnStart) {
			$cbOnStart($this);
		}

		$this->initException();
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
	 * @return MapperService
	 */
	public function mapper()
	{
		if(!$this->mapper) {
			$this->mapper = Mapper::single()->init();
		}
		return $this->mapper;
	}

	/**
	 * @return AutoLoader
	 */
	public function autoLoader()
	{
		if(!$this->autoLoader) {
			$this->autoLoader = AutoLoader::single();
		}
		return $this->autoLoader;
	}

    /**
     * @return $this
     */
    public function initException()
    {
        $handler = function(\Exception $exception){
            //$eClass = $this->configurator->getMapping(Cube::MAPPING_EXCEPTION);
            if(!($exception instanceof Exception)) {
                $e = Exception::instance($exception->getMessage());
                $e->setFile($exception->getFile(), $exception->getLine());
                $exception = $e;
            }
            print($exception->render());
            exit;
        };
        set_exception_handler($handler);
        return $this;
    }
}