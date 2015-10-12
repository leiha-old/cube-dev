<?php

use Cube\Application\Application;

require '../../vendors/Cube/Cube.php';

$cube = Application::init(function(Application $cube){
	$cube
		->autoLoader()
			->add('Application', realpath(__DIR__.'/../').'/')
	;
});

$generator = new \Cube\Generator\ClassGenerator('toto');
$generator->addMethod(
    /**
     * @param string $toto
     * @param string $eeee
     * @visibility public
     */
    function ( $toto, $eeee ) {
        $rr = 'eeeeeeeeeeeeeeeeeeeeeeeee';
        $ee = function(){

        };
        if($ee) {
            $rr = 'vvvvvvvvvvvvvvvv';
        }

    }
);