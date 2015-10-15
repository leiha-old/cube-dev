<?php

namespace Cube\Connector\Slim;

use Lia\Application\Application;
use Cube\Logger\Logger;
use Slim\Log;

class SlimLogger
    extends Logger
{
    /**
     * @param \Closure|null $callback ($wrapped)
     */
    public function __construct(\Closure $callback = null)
    {
        $wrapped = $this->getApplication()
            ->getRouter()
                ->getWrapped()
                    ->getLog()
        ;

        $this->setWrapper($wrapped);
        if($callback) {
            $callback($wrapped);
        }
    }

    /**
     * @param string $type
     * @param string $msg
     * @param array $data
     * @param array $context
     * @return mixed
     */
    protected function log($type, $msg, array $data = array(), array $context = array())
    {
        // Todo: Make a parser for data injection in $msg

        $msg = \logHelper::cleanString($msg);

        return $this->getWrapped()->$type($msg, $context);
    }

    /**
     * @return SlimApplication
     */
    public static function getApplication() {
        return Application::getApplication();
    }

    /**
     * @return Log
     */
    public function getWrapped()
    {
        return parent::getWrapped();
    }


}