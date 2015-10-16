<?php
/**
 * Created by PhpStorm.
 * User: lia
 * Date: 01/10/15
 * Time: 10:53
 */

namespace Cube\Db;

class DbFacade
    implements DbConstants
{
    const CHARSET_utf8 = 'utf8';

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $driver = self::DB_DRIVER_mysql;

    /**
     * @var array
     */
    private $options = array();

    /**
     * @var array
     */
    private $onInitConnectionCommands = array();

    /**
     * @var string
     */
    private $dsn;

    /**
     * @var string
     */
    private $host;

    /**
     * @var string
     */
    private $database;

    /**
     * @var string
     */
    private $charSet = self::CHARSET_utf8;

    /**
     * @param string $driverName
     * @return $this
     */
    public function setDriver($driverName = self::DB_DRIVER_mysql)
    {
        $this->driver = $driverName;
        return $this;
    }

    /**
     * @param string $username
     * @param string $password
     * @return $this
     */
    public function setAuth($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
        return $this;
    }

    /**
     * @return string
     */
    public function getUserName()
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $name
     * @param string $value
     * @return $this
     */
    public function addOption($name, $value)
    {
        $this->options[$name] = $value;
        return $this;
    }

    /**
     * @return string
     */
    public function getDsn()
    {
        $dbType = $this->driver;
        if(preg_match("/^pdo_(\w+)$/", $dbType, $matches)) {
            $dbType = $matches[1];
        }

        return $this->dsn
            ? $this->dsn
            : $dbType
                .':host='   .$this->getHost()
                .';dbname=' .$this->getDatabase()
                .';charset='.$this->getCharSet()
            ;
    }

    /**
     * @param string $dsn
     * @return string
     */
    public function setDsn($dsn)
    {
        $this->dsn = $dsn;
        return $this;
    }

    /**
     * @param array $options
     * @return $this
     */
    public function addOptions(array $options)
    {
        $this->options = array_merge($this->options, $options);
        return $this;
    }

    /**
     * @param string $command
     * @return $this
     */
    public function addCommandOnInit($command)
    {
        $this->onInitConnectionCommands[] = $command;
        return $this;
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        $options = $this->options;
        if(count($this->onInitConnectionCommands)) {
            $options[\PDO::MYSQL_ATTR_INIT_COMMAND] = implode(';', $this->onInitConnectionCommands);
        }
        return $options;
    }

    /**
     * @param string $host
     * @return DbConfigurator
     */
    public function setHost($host)
    {
        $this->host = $host;
        return $this;
    }

    /**
     * @return string
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @return string
     */
    public function getDatabase()
    {
        return $this->database;
    }

    /**
     * @param string $database
     * @return $this
     */
    public function setDatabase($database)
    {
        $this->database = $database;
        return $this;
    }

    /**
     * @return string
     */
    public function getCharSet()
    {
        return $this->charSet;
    }

    /**
     * @param string $charSet
     * @return $this
     */
    public function setCharSet($charSet = self::CHARSET_utf8)
    {
        $this->charSet = $charSet;
        return $this;
    }
}