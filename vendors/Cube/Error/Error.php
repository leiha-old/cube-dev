<?php

namespace Cube\Error;

class Error
    implements ErrorInterface
{
    /**
     * @param string $handler
     */
    public static function ____init($handler = 'Cube\Error\Error::____handler') {
        set_error_handler($handler);
    }

    /**
     * @param int $code
     * @param string $msg
     * @param string $file
     * @param int $line
     * @param array $context
     * @throws ErrorException
     */
    public static function ____handler($code, $msg, $file, $line, $context) {
        $exception = (new ErrorException($msg))->setFile($file, $line);
        echo $exception->render();
        exit;
    }
}