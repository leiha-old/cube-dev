<?php

use Cube\Application\Application;
use Cube\Application\ApplicationFacade;

require '../../vendors/Cube/Cube/Cube.php';

$cube = Application::init(
    function(ApplicationFacade $facade, Application $cube)
    {
        $facade
            ->fileSystem()
                ->addIncludePath('Application', realpath(__DIR__.'/../').'/')
                ->addIncludePath('Slim'       , realpath(__DIR__.'/../../vendors/Slim/').'/')
                ;

         $facade
             ->http()
                ->mapRouter($cube::CONNECTOR_SLIM_router)
                ->get('/', 'Application\Controller\Home', 'home')
                ;
    }
);

$cube->run();