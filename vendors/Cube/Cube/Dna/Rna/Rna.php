<?php

namespace Cube\Dna\Rna;

use Cube\Collection\Collection;
use Cube\Dna\Dna;
use Cube\Generator\ClassGenerator;

class Rna
{
    /**
     * @var Dna
     */
    private $dna;

    public function __construct()
    {
        $this->dna = Dna::single();
    }

    protected function buildTree()
    {
        $dna = array();
        $this->dna->iterateOnGene(
            function (array &$gene, $geneId)
            use (&$dna)
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
    }

    public function BuildObjectTree() {

        $generator = new ClassGenerator('toto', ClassGenerator::CLASS_TYPE_class);
        $generator
            ->setNameSpace('Test\Generator')
        ;

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
    }
}