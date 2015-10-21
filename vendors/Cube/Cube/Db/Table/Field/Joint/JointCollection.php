<?php
/**
 * Created by PhpStorm.
 * User: lia
 * Date: 23/09/15
 * Time: 12:12
 */

namespace Cube\Db\Table\Field\Joint;

use Cube\Db\Table\Field\Field;
use Cube\Db\Table\Table;

class JointCollection
{
    const TABLE_JOIN_oneToOne  = 'oneToOne';
    const TABLE_JOIN_oneToMany = 'oneToMany';

    /**
     * @var Table[]
     */
    private $tables  = array();

    /**
     * @var Joint[]
     */
    private $oneToMany = array();

    /**
     * @var Joint[]
     */
    private $oneToOne = array();

    /**
     * @var Field
     */
    private $parentFieldTmp;


    /**
     * @param string $foreignTableName
     * @return Joint
     */
    public function joinTo($foreignTableName)
    {
        if(!isset($this->tables[$foreignTableName])) {
            $this->tables[$foreignTableName] = new Joint($foreignTableName, $this->parentFieldTmp, $this);
        }
        return $this->tables[$foreignTableName];
    }

    /**
     * @param string $foreignTableName
     * @return Joint
     */
    public function addOneToOne($foreignTableName)
    {
        if(!isset($this->oneToOne[$foreignTableName])) {
            $this->oneToOne[$foreignTableName] = new Joint($foreignTableName, $this->parentFieldTmp, $this);
        }
        return $this->oneToOne[$foreignTableName];
    }

    /**
     * @param Field $field
     * @return $this
     */
    public function setParentFieldTmp(Field $field)
    {
        $this->parentFieldTmp = $field;
        return $this;
    }

    /**
     * @return Field
     */
    public function end()
    {
        return $this->parentFieldTmp;
    }
}