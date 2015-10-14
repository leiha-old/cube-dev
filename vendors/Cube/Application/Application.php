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
use Cube\Dna\Dna;
use Cube\Dna\Gene\GeneBehavior;
use Cube\FileSystem\AutoLoader\AutoLoader;
use Cube\FileSystem\FileSystem;
use Cube\Generator\ClassGenerator;
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
    public $dna;

    /**
     * @param \Closure|null $cbOnStart
     * @return static
     */
    public static function init(\Closure $cbOnStart = null) {
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
        $this->dna  = $mapper->singleTo('Cube\Dna\Dna');
        $this->dna
            ->injectInstance('cube.mapper'    , $mapper)
            ->injectInstance('cube.fileSystem', $fileSystem)
        ;


        $this->createRna();

        $e = 'e';
	}

    public function createRna() {

        $generator = new ClassGenerator('toto', ClassGenerator::CLASS_TYPE_class);
        $generator
            ->setNameSpace('Test\Generator')
            ;

        $dna = array();
        $this->dna()->iterateOnGene(
            function (array &$gene, $geneId)
                use ($generator, &$dna)
            {
                $c[-1]   = array();
                $explode = explode('.', $geneId);
                Collection::iterateArrayWithCounter($explode,
                    function ($isEnd, $value, $key, $counter, $total)
                        use (&$dna, &$c, &$gene)
                    {
                        $c[$counter-1][$value] = /*$isEnd ? array('__GENE__' => $gene) :*/ array();
                        $c[$counter] = &$c[$counter-1][$value];
                    }
                );
                $dna = array_merge_recursive($dna, $c[-1]);
            }
        );

        Collection::iterateArray($dna,
            function(&$value, $key)
                use ($generator)
            {
                $generator->addMethod(
                    /**
                     * @name $$geneId
                     * @visibility public
                     * @return $$geneClass
                     */
                    function () {},
                    compact('geneId', 'geneClass')
                );
        });


            $eee = '';

//                $generator->addMethod(
//                /**
//                 * @name $$geneId
//                 * @visibility public
//                 * @return $$geneClass
//                 */
//                    function () {},
//                    compact('geneId', 'geneClass')
//                );




        $render = $generator->render();
        $ee = '';
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