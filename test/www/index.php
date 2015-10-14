<?php

use Cube\Application\Application;

require '../../vendors/Cube/Cube.php';

$cube = Application::init(function(Application $cube){
	$cube
		->autoLoader()
			->add('Application', realpath(__DIR__.'/../').'/')
	;


});

$generator = new \Cube\Generator\ClassGenerator('toto', \Cube\Generator\ClassGenerator::CLASS_TYPE_abstract);
$generator
    ->setNameSpace('Test\Generator')
    ->setExtend('FakeExtend')
    ->addInterface(array('TotoInterface', 'LooInterface'))
    ->addTrait(array('TotoTrait', 'LooTrait'))
    ->addMethod(
        /**
         * @name loulou
         * @param string $toto
         * @param string $eeee
         * @visibility public

         */
        function ( $toto, $eeee ) {
            $rr = 'eeeeeeeeeeeeeeeeeeeeeeeee';
            $$ee = function(){

            };
            if($ee) {
                $rr = 'vvvvvvvvvvvvvvvv';
            }
        }, array('ee' => 'o_o')
    );

    $ttt = $generator->render();
$rr = '';


