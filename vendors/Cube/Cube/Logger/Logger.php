<?php
/**
 * Created by PhpStorm.
 * User: lia
 * Date: 15/10/15
 * Time: 20:37
 */

namespace Cube\Logger;

class Logger
    extends LoggerWrapper
{

    /**
     * @param string $type
     * @param string $msg
     * @param array $data
     * @param array $context
     * @return mixed
     */
    protected function log($type, $msg, array $data = array(), array $context = array())
    {
        // TODO: Implement log() method.
    }
}