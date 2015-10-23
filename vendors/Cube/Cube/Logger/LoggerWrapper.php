<?php

namespace Cube\Logger;

use Cube\Poo\Wrapper\Wrapper;

abstract class LoggerWrapper
    extends    Wrapper
    implements LoggerBehavior
{
    use LoggerHelper;
}