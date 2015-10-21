<?php
/**
 * Created by PhpStorm.
 * User: lia
 * Date: 15/10/15
 * Time: 15:09
 */

namespace Cube\Application;

use Cube\CubeFacade;
use Cube\Error\ErrorException;
use Cube\FileSystem\FileSystemFacade;
use Cube\Http\HttpFacade;
use Cube\Poo\Exception\Exception;

class ApplicationFacade
    extends    CubeFacade
    implements ApplicationFacadeBehavior
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

    public function setExceptionHandler ()
    {
        $handler = function(\Exception $exception)
        {
            if(!($exception instanceof Exception)) {
                $e = Exception::instance($exception->getMessage());
                $e->setFile($exception->getFile(), $exception->getLine());
                $exception = $e;
            }
            print($exception->render());
            exit;
        };
        set_exception_handler($handler);
        return $this;
    }

    public function setErrorHandler ()
    {
        /**
         * @param int $code
         * @param string $msg
         * @param string $file
         * @param int $line
         * @param array $context
         * @throws ErrorException
         */
        $handler = function($code, $msg, $file, $line, $context)
        {
            throw (new ErrorException($msg))
                ->setFile($file, $line)
            ;
        };
        set_error_handler($handler);
        return $this;
    }
}