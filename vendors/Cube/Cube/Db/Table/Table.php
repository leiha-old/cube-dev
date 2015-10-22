<?php
/**
 * Created by PhpStorm.
 * User: lia
 * Date: 17/09/15
 * Time: 16:15
 */

namespace Cube\Db\Table;

use Cube\Db\Db;
use Cube\Db\Table\Field\Field;
use Cube\Validator\FieldSet\FieldSet;

class Table
    extends FieldSet
{
    const CLASS_fieldSet     = 'Cube\Db\Table\Table';
    const CLASS_field        = 'Cube\Db\Table\Field\Field';

    const DB_name            = '';
    const TABLE_prefixFields = '';
    const TABLE_name         = '';

    /**
     * @var Db
     */
    protected $database;

    public function __construct() {
        parent::__construct  (static::TABLE_name);

    }

    /**
     * @return Db
     */
    public function getDatabase()
    {
        return $this->database;
    }

    /**
     * @param Db $database
     * @return $this
     */
    public function setDatabase(Db $database)
    {
        $this->database = $database;
        return $this;
    }

    /**
     * @param string $tableName
     * @return Table
     */
    public static function get($tableName)
    {
       return parent::get($tableName);
    }

    /**
     * @param string $fieldName
     * @param mixed  $defaultValue
     * @param string $type          Field::TYPE_*
     * @return Field
     */
    public function addField($fieldName, $defaultValue = null, $type = self::TYPE_string)
    {
        /** @var Field $field */
        $field = parent::addField($fieldName, $defaultValue, $type);
        return $field
            ->setFieldPrefix(self::TABLE_prefixFields)
            ;
    }

    /**
     * @return int
     */
    private function getMetaDataOnDb()
    {
        /* @var \PDOStatement $result */
        $result  = $this->database->query('SHOW COLUMNS FROM '.static::TABLE_name)->fetchAll();
        $columns = array();
        foreach($result as $column){
            $fieldName = $column['Field'];
            preg_match('#([a-z]+)(?:\((.*)\)|)#', $column['Type'], $matches);

            $columns['fields'][$fieldName] = array(
                'type' => $matches[1],
                'size' => isset($matches[2]) ? $matches[2] : ''
            );

            if('PRI' == $column['Key']){
                $columns['primaryKey'] = $fieldName;
            }
        }
    }
}