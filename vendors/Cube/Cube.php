<?php

namespace Cube;

include_once(__DIR__.'/FileSystem/AutoLoader/AutoLoader.php');

use Cube\FileSystem\AutoLoader\AutoLoader;
use Cube\FileSystem\FileSystem;
use Cube\FileSystem\FileSystemService;
use Cube\Poo\Mapper\Mappable\MappableHelper;
use Cube\Poo\Service\Service;
use Cube\Template\Template;

abstract class Cube
    implements CubeConstants
{
    use MappableHelper;

	/**
	 * @var FileSystemService
	 */
	private $fileSystem;

    /**
     * @var Service
     */
    public $services;

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

        $fileSystem     = $this->fileSystem();
		$mapper         = $this->mapper()->setAll($fileSystem->crawler()->findClasses());
        $this->services = $mapper->singleTo('Cube\Poo\Service\Service');
        $this->services
            ->injectInstance('cube.mapper'    , $mapper)
            ->injectInstance('cube.fileSystem', $fileSystem)
        ;


        $this->createDna();

		$e = 'e';
	}

    public function createDna() {

//        $tpl = Template::instance();
//        $tpl->addForEachSection('dna.methods', function(Template $engine, $item){
//            return "
//                /**
//                 * @return $item[className]
//                 */
//                public function $item[methodName]();
//            ";
//        });
        //$tpl->addSection('ee', 'vvvv');


        $this->services()->iterateOnService(function ($service, $key) {
            $ee = '';
        });
    }

    /**
     * @return Service
     */
    public function services()
    {
        return $this->services;
    }

	/**
	 * @return FileSystem
	 */
	public function fileSystem()
	{
		if(!$this->fileSystem) {
			$this->fileSystem = FileSystem::instance(AutoLoader::getListOfIncludeFiles());
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