<?php

use Cube\Application\Application;
use Cube\Application\ApplicationFacade;

require '../../vendors/Cube/Cube/Cube.php';

$cube = Application::init(
    function(ApplicationFacade $configurator, Application $cube)
    {
        $configurator
            ->http()
                ->setRouterClass($cube::CONNECTOR_SLIM_router)
                ->end()
            ->fileSystem()
                ->addIncludePath('Application', realpath(__DIR__.'/../').'/')
                ->end()
            ;
    }
);


$rr = '';


