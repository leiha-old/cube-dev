<?php

namespace Cube\Logger;

abstract class Logger
    implements LoggerInterface
{
    public function run() { }

    /**
     * @param string $type
     * @param string $msg
     * @param array $data
     * @param array $context
     * @return mixed
     */
    abstract protected function log($type, $msg, array $data = array(), array $context = array());

    /**
     * Log debug message
     * @param string $msg
     * @param array $data
     * @param array $context
     * @return mixed|bool What the Logger returns, or false if Logger not set or not enabled
     */
    public function debug($msg, array $data = array(), $context = array())
    {
        return $this->log('debug', $msg, $data, $context);
    }

    /**
     * Log info message
     * @param string $msg
     * @param array $data
     * @param array $context
     * @return mixed|bool What the Logger returns, or false if Logger not set or not enabled
     */
    public function info($msg, array $data = array(), $context = array())
    {
        return $this->log('info', $msg, $data, $context);
    }

    /**
     * Log notice message
     * @param string $msg
     * @param array $data
     * @param array $context
     * @return mixed|bool What the Logger returns, or false if Logger not set or not enabled
     */
    public function notice($msg, array $data = array(), $context = array())
    {
        return $this->log('notice', $msg, $data, $context);
    }


    /**
     * Log alert message
     * @param string $msg
     * @param array $data
     * @param array $context
     * @return bool|mixed What the Logger returns, or false if Logger not set or not enabled
     */
    public function alert($msg, array $data = array(), $context = array())
    {
        return $this->log('alert', $msg, $data, $context);
    }

    /**
     * Log warning message
     * @param string $msg
     * @param array $data
     * @param array $context
     * @return mixed|bool What the Logger returns, or false if Logger not set or not enabled
     */
    public function warning($msg, array $data = array(), $context = array())
    {
        return $this->log('warning', $msg, $data, $context);
    }

    /**
     * Log error message
     * @param string $msg
     * @param array $data
     * @param array $context
     * @return mixed|bool What the Logger returns, or false if Logger not set or not enabled
     */
    public function error($msg, array $data = array(), $context = array())
    {
        return $this->log('error', $msg, $data, $context);
    }

    /**
     * Log critical message
     * @param string $msg
     * @param array $data
     * @param array $context
     * @return mixed|bool What the Logger returns, or false if Logger not set or not enabled
     */
    public function critical($msg, array $data = array(), $context = array())
    {
        return $this->log('critical', $msg, $data, $context);
    }
}