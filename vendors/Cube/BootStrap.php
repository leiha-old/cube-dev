<?php

namespace Cube;

use Cube\Cube\Cube;
use Cube\Cube\CubeException;
use Cube\Error\Error;
use Cube\Exception\Exception;
use Cube\Dna\Dna;
use Cube\FileSystem\FileSystem;
use Cube\Wizard\Wizard;

class BootStrap
{
    /**
     * @param string $mainCubeClass
     * @param string $includePath
     * @return Cube
     * @throws \Exception
     */
    public static function init($mainCubeClass, $includePath)
    {
        Error      ::____init();
        Exception  ::____init();
        $autoLoader = AutoLoader::single()->add('Application', $includePath);

        Wizaaard::extractClasses();



//        Dna::single()
//            ->injectGene  ('Cube\FileSystem\FileSystem', array($autoLoader->getListOfIncludeFiles()))
//            ->injectMutant('cube.autoLoader'           , $autoLoader)
//            ;
//
//        print_r(Dna::single()->getAll());

        //return Dna::loader()->loadOnLazy($mainCubeClass);
    }


}