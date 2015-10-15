<?php

namespace Cube\Logger;

interface LoggerBehavior
{
    /**
     * Log debug message
     * @param string $msg
     * @param array $data
     * @param array $context
     * @return mixed|bool What the Logger returns, or false if Logger not set or not enabled
     */
    public function debug($msg, array $data = array(), $context = array());

    /**
     * Log info message
     * @param string $msg
     * @param array $data
     * @param array $context
     * @return mixed|bool What the Logger returns, or false if Logger not set or not enabled
     */
    public function info($msg, array $data = array(), $context = array());

    /**
     * Log notice message
     * @param string $msg
     * @param array $data
     * @param array $context
     * @return mixed|bool What the Logger returns, or false if Logger not set or not enabled
     */
    public function notice($msg, array $data = array(), $context = array());

    /**
     * Log alert message
     * @param string $msg
     * @param array $data
     * @param array $context
     * @return bool|mixed What the Logger returns, or false if Logger not set or not enabled
     */
    public function alert($msg, array $data = array(), $context = array());

    /**
     * Log warning message
     * @param string $msg
     * @param array $data
     * @param array $context
     * @return mixed|bool What the Logger returns, or false if Logger not set or not enabled
     */
    public function warning($msg, array $data = array(), $context = array());

    /**
     * Log error message
     * @param string $msg
     * @param array $data
     * @param array $context
     * @return mixed|bool What the Logger returns, or false if Logger not set or not enabled
     */
    public function error($msg, array $data = array(), $context = array());

    /**
     * Log critical message
     * @param string $msg
     * @param array $data
     * @param array $context
     * @return mixed|bool What the Logger returns, or false if Logger not set or not enabled
     */
    public function critical($msg, array $data = array(), $context = array());

}