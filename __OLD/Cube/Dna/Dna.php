<?php
/**
 * Class Dna
 * @author Leiha Sellier <leiha.sellier@gmail.com>
 * @link   https://github.com/leiha
 * -
 */

namespace OLD\Cube\Dna;

use Cube\Collection\CollectionBehavior;
use Cube\Core\Instance\Single\SingleBehavior;
use Cube\Dna\Gene\GeneInterface;
use Cube\Dna\Gene\GeneConfigurator;
use Cube\FileSystem\FileSystem;

class Dna
    implements DnaBehaviorInterface
{
    const INJECTION_GENE   = 'gene';
    const INJECTION_MUTANT = 'mutant';

    use DnaBehavior;
    use SingleBehavior;

    use CollectionBehavior {
        set as protected;
        //get as private _get;
    }

    /**
     * @param DnaConfigurator $configurator
     * @return mixed
     */
    public function ____configureDna(DnaConfigurator $configurator)
    {
        // TODO: Implement ____configureDna() method.
    }

    /**
     * @param $uniqueId
     * @return mixed
     * @throws \Cube\Collection\CollectionException
     */
    public function getGene($uniqueId)
    {
//        try {
            $gene = &$this->get($uniqueId);
            switch($gene['type']) {

                case Dna::INJECTION_GENE   :
                    $class = &$gene[$gene['type']];
                    if(is_string($class)) {
                        /** @var GeneConfigurator $configurator */
                        $configurator = $gene['configurator'];
                        $mode         = $configurator->getGeneMode();
                        $class        = $class::{$mode.'With'}($class, $gene['args']);
                    }
                    return $class;
                    break;

                case Dna::INJECTION_MUTANT :
                    return $gene[$gene['type']];
                    break;

            }
//        }
//        catch (CollectionException $e) {
//
//        }

    }

    /**
     * @param $class
     * @param array $args
     * @return $this
     * @throws \Cube\Collection\CollectionException
     */
    public function injectGene($class, array $args = array())
    {
        if(!($class instanceof GeneInterface)) {

        }

        $configurator = new GeneConfigurator();

        /** @var GeneInterface    $class */
        $class::____configureGene      ($configurator);
        $class::____setGeneConfigurator($configurator);

        $this->set($configurator->getUniqueName(), array(
            'type'              => Dna::INJECTION_GENE,
            'args'              => $args,
            'configurator'      => $configurator,
            Dna::INJECTION_GENE => $class
        ));

        //$this->generateDnaTree();

        return $this;
    }

    /**
     * @param $uniqueName
     * @param $object
     * @param array $args
     * @return $this
     * @throws \Cube\Collection\CollectionException
     */
    public function injectMutant($uniqueName, $object, array $args = array())
    {
        $this->set($uniqueName, array(
            'type'                => Dna::INJECTION_MUTANT,
            'args'                => $args,
            Dna::INJECTION_MUTANT => $object
        ));
        return $this;
    }

    public function generateDnaTree()
    {
        /** @var FileSystem $fileSystem */
        $fileSystem = $this->getGene('cube.fileSystem');
        //$fileSystem->

        $content = '';
        $this->iterate(function($item, $key) use (&$content){
            $return = $item[$item['type']];
            $key = explode('.', $key);
            array_walk($key, function(&$value){
                $value = ucfirst($value);
            });
            $key = implode('', $key);

            $content .= <<<EOF

        /**
         * @return $return
         */
        public function $key ();
EOF;
        });

            $content = <<<EOF

        /**
         * Generated Automatically
         */

        namespace OLD\Cube\Dna;

        interface DnaInterface {
            $content
        }
EOF;

        $e = 'e';



        //$fileSystem->writeIn('DnaInterface', $content);






    }
}