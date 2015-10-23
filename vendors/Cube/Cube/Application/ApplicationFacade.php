<?php
/**
 * Created by PhpStorm.
 * User: lia
 * Date: 15/10/15
 * Time: 15:09
 */

namespace Cube\Application;

use Cube\CubeFacade;
use Cube\FileSystem\FileSystemFacade;
use Cube\Http\HttpFacade;
use Cube\Poo\Error\Error;

class ApplicationFacade
    extends    CubeFacade
    implements ApplicationBehavior,
               ApplicationConstants
{
    /**
     * @return HttpFacade
     */
    public function http() {
        return HttpFacade::single()
            ->setParentFacade($this)
            ;
    }

    /**
     * @return FileSystemFacade
     */
    public function fileSystem() {
        return FileSystemFacade::single($this)
            ->setParentFacade($this)
            ;
    }

    /**
     * @throws Error
     */
    public function initError()
    {
        /**
         * @param int $code
         * @param string $msg
         * @param string $file
         * @param int $line
         * @param array $context
         * @throws Error
         */
        $handler = function($code, $msg, $file, $line, $context)
        {
            throw (new Error($msg))
                ->setFile($file, $line)
            ;
        };
        set_error_handler($handler);
        return $this;
    }

    /**
     * @return $this
     */
    public function initException()
    {
        $handler = function(\Exception $Error)
        {
            //$eClass = $this->configurator->getMapping(Cube::MAPPING_Error);
            if(!($Error instanceof Error)) {
                $e = Error::instance($Error->getMessage());
                $e->setFile($Error->getFile(), $Error->getLine());
                $Error = $e;
            }
            print($Error->render());
            exit;
        };
        set_exception_handler($handler);
        return $this;
    }
}