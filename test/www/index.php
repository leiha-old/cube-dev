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


        $controller = 'Application\Controller\Home';
        $facade
             ->http()
                ->mapRouter($cube::CONNECTOR_SLIM_router)
                ->get('/'    , $controller, 'home')
                ->get('/form', $controller, 'form')
                ;
    }
);

$cube->run();