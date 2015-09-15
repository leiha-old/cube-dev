<?php
/**
 * Class ExceptionInterface
 * @author Leiha Sellier <leiha.sellier@gmail.com>
 * @link   https://github.com/leiha
 * -
 */

namespace Cube\Error;

interface ErrorInterface
{
    public static function ____init($handler = 'Cube\Error::____handler');

    /**
     * @param int $code
     * @param string $msg
     * @param string $file
     * @param int $line
     * @param array $context
     */
    public static function ____handler($code, $msg, $file, $line, $context);
}