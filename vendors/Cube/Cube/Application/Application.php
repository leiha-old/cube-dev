<?php
/**
 * Class Application
 * @author Leiha Sellier <leiha.sellier@gmail.com>
 * @link   https://github.com/leiha
 * -
 */

namespace Cube\Application;

use Cube\Cube;
use Cube\Dna\Dna;
use Cube\FileSystem\AutoLoader\AutoLoader;
use Cube\FileSystem\FileSystem;
use Cube\Generator\ClassGenerator;
use Cube\Http\Router\Router;
use Cube\Http\Router\RouterBehavior;
use Cube\Poo\Mapper\Mapper;

class Application
	extends Cube
    implements ApplicationConstants
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

        /** @noinspection ExceptionsAnnotatingAndHandlingInspection */
        $facade = ApplicationFacade::instance()
            ->initError()
            ->initException()
        ;

        if($cbOnStart) {
            $cbOnStart($facade);
        }


        return self::single($facade);
    }

    /**
     * @param ApplicationFacade $facade
     * @internal param \Closure $cbOnStart
     */
	public function __construct(ApplicationFacade $facade)
	{
        $fileSystem = $this->fileSystem();
        $mapper     = self::mapper()->mapAll($fileSystem->crawler()->findClasses());

        //parent::__construct($facade);

        $router = $this->router();
        $this->dna()
            ->injectInstance('cube.mapper'    , $mapper)
            ->injectInstance('cube.fileSystem', $fileSystem)
            ->injectInstance('cube.router'    , $router)
        ;
    }

    /**
     * @return void
     */
    public function run()
    {
        $this->router()->run();
    }

    /**
     * @return Router
     */
    public function router()
    {
        return Router::single();
    }

    /**
     * @return ApplicationFacade
     */
    public static function newFacade()
    {
        return ApplicationFacade::instance();
    }

    /**
     * @return Dna
     */
    public function dna()
    {
        return Dna::single();
    }

    /**
     * @return FileSystem
     */
    public function fileSystem()
    {
        if(!$this->fileSystem) {
            $this->fileSystem = FileSystem::single(AutoLoader::getListOfIncludeFiles(false));
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