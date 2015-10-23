<?php
/**
 * Created by PhpStorm.
 * User: lia
 * Date: 01/10/15
 * Time: 10:12
 */

namespace Cube\Db;


class Db
    extends \PDO
{
    /**
     * @var DbFacade
     */
    protected $configurator;

    /**
     * @var DbFacade[]
     */
    private static $_configurators = array();

    /**
     * @var Db[]
     */
    private static $_databases = array();

    /**
     * @param string $connectionName
     * @return bool
     */
    public static function hasConfigurator($connectionName) {
        return array_key_exists($connectionName, self::$_databases);
    }

    /**
     * @param string $connectionName
     * @return DbFacade
     */
    public static function getConfigurator($connectionName)
    {
        if(!self::hasConfigurator($connectionName)) {
            self::$_configurators[$connectionName] = new DbFacade();
        }
        return self::$_configurators[$connectionName];
    }

    /**
     * @param string $connectionName
     * @return Db
     */
    public static function get($connectionName)
    {
        if(!array_key_exists($connectionName, self::$_databases)) {
            self::$_databases[$connectionName] = new static(static::getConfigurator($connectionName));
        }
        return self::$_databases[$connectionName];
    }

    /**
     * @param DbFacade $configurator
     */
    public function __construct(DbFacade $configurator)
    {
        $this->configurator = $configurator;
        parent::__construct(
            $configurator->getDsn(),
            $configurator->getUserName(),
            $configurator->getPassword(),
            $configurator->getOptions()
        );
    }

    /**
     * @param string $query
     * @param \closure $callback (PDOStatement $stmt)
     * @return string
     * @throws DbError
     */
    public function prepareAndExecute($query, \closure $callback = null)
    {
//        $this->getApplication()
//            ->getLogger()
//            ->info($query)
//        ;

        try {
            $stmt = $this->prepare($query);
            $stmt->execute();
            if($callback) {
                return $callback($stmt);
            }
            return $stmt;
        }
        catch (\PDOError $e) {
            throw new DbError($e->getMessage());
        }
    }
}