<?php

use Application\Controller;
use Cube\Application\Application;
use Cube\Application\ApplicationBehavior;
use Cube\Connector\Connector;

require '../../vendors/Cube/Cube/Cube.php';

$cube = Application::init(
    function(ApplicationBehavior $facade)
    {
        $facade
            ->fileSystem()
                ->addIncludePath('Application', realpath(__DIR__.'/../').'/')
                ->addIncludePath('Slim'       , realpath(__DIR__.'/../../vendors/Slim/').'/')
                ;

        $facade
             ->http()
                ->router(Connector::SLIM_Router)
                    ->get('/'    , Controller::Home, 'home')
                    ->get('/form', Controller::Home, 'form')
                ;
    }
);

$cube->run();