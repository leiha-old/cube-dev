<?php
/**
 * Class InstanceConfigurator
 * @author Leiha Sellier <leiha.sellier@gmail.com>
 * @link   https://github.com/leiha
 * -
 */

namespace Cube\Core\Instance;

class InstanceConfigurator
{
    /**
     * @var string
     */
    private $_className;

    public function __construct()
    {

    }

    /**
     * @param string $className
     * @return $this
     */
    public function setClassName($className)
    {
        $this->_className = $className;
        return $this;
    }

    /**
     * @return string
     */
    public function getClassName()
    {
        return $this->_className;
    }
}