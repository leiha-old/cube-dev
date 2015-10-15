<?php
/**
 * Class Application
 * @author Leiha Sellier <leiha.sellier@gmail.com>
 * @link   https://github.com/leiha
 * -
 */

namespace Cube\Application;

use Cube\Collection\Collection;
use Cube\Cube;
use Cube\CubeConfigurator;
use Cube\Dna\Dna;
use Cube\Dna\Gene\GeneBehavior;
use Cube\FileSystem\AutoLoader\AutoLoader;
use Cube\FileSystem\FileSystem;
use Cube\Generator\ClassGenerator;
use Cube\Http\Router\RouterBehavior;
use Cube\Poo\Exception\Exception;
use Cube\Poo\Mapper\Mapper;

class Application
	extends Cube
{
    /**
     * @var FileSystem
     */
    private $fileSystem;

    /**
     * @var Dna
     */
    protected $dna;

    /**
     * @var RouterBehavior
     */
    protected $router;



    /**
     * @param \Closure|null $cbOnStart
     * @return static
     */
    public static function init(\Closure $cbOnStart = null)
    {
        Mapper::init();
        return self::single($cbOnStart);
    }

	/**
	 * @param \Closure $cbOnStart
	 */
	public function __construct(\Closure $cbOnStart = null)
	{
        $this->initException();
        parent::__construct($cbOnStart);

        $fileSystem = $this->fileSystem();
        $mapper     = $this->mapper()->setAll($fileSystem->crawler()->findClasses());
        $router     = $this->router();

        $this->dna  = Dna::single();
        $this->dna
            ->injectInstance('cube.mapper'    , $mapper)
            ->injectInstance('cube.fileSystem', $fileSystem)
            ->injectInstance('cube.router'    , $router)

        ;
    }

    /**
     * @return ApplicationConfigurator
     */
    public function getConfigurator()
    {
        return $this->configurator;
    }

    public function router()
    {
        if(!$this->fileSystem) {
            $this->fileSystem = FileSystem::instance(AutoLoader::getListOfIncludeFiles(false));
        }
        return $this->fileSystem;




    }

    /**
     * @return ApplicationConfigurator
     */
    public static function getConfiguratorInstance()
    {
        return ApplicationConfigurator::instance();
    }

    /**
     * @return Dna
     */
    public function dna()
    {
        return $this->dna;
    }

    /**
     * @return FileSystem
     */
    public function fileSystem()
    {
        if(!$this->fileSystem) {
            $this->fileSystem = FileSystem::instance(AutoLoader::getListOfIncludeFiles(false));
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

	/**
	 * @return $this
	 */
	private function initException()
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