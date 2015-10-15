<?php

namespace Cube\Connector\Slim;

use Cube\Application\Application;

class SlimApplication
    extends Application
{
    /**
     * @var SlimLogger
     */
    protected $logger;

    /**
     * @var SlimRouter
     */
    protected $router;

    /**
     * @return SlimLogger
     */
    public function getLogger()
    {
        if(!$this->logger) {
            $this->logger = new SlimLogger();
            $this->logger->getWrapped()->setEnabled(true);
        }

        return $this->logger;
    }

    /**
     * @param bool $wrapped
     * @return SlimRouter
     */
    public function getRouter($wrapped = false)
    {
        if(!$this->router) {
            $this->router = new SlimRouter(array (
                'log.writer' => new \logHelper (array (
                    'path'          => LOG_DIRECTORY_PATH,
                    'fileName'      => 'odapi_hosts',
                    'extension'     => 'log',
                    'messageFormat' => '%host% - %user% [%dateTime%] "%referer%" "%userAgent%" : %message%'
                ))
            ));
        }

        return $wrapped
            ? $this->router->getWrapped()
            : $this->router
            ;
    }
}