<?php
/**
 * Class ExceptionInterface
 * @author Leiha Sellier <leiha.sellier@gmail.com>
 * @link   https://github.com/leiha
 * -
 */

namespace OLD\Cube\Exception;

interface ExceptionInterface
{
    /**
     * @param string $handler
     */
    public static function ____init($handler = 'Cube\Exception\Exception::____handler');

    /**
     * @param \Exception $exception
     */
    public static function ____handler(\Exception $exception);
}