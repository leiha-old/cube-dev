<?php

namespace Cube\Db\Table\Field;

use Cube\Db\Table\Field\Joint\JointCollection;
use Cube\Db\Table\Table;

class Field
    extends \Cube\Validator\Field\Field
{
    /**
     * @var JointCollection
     */
    private static $_joints;

    /**
     * @var string
     */
    private $fieldPrefix;

    /**
     * @var bool
     */
    private $primaryKey = false;

    /**
     * @param string  $fieldName
     * @param Table   $parentFieldSet
     */
    public function __construct($fieldName, Table $parentFieldSet = null)
    {
        parent::__construct($fieldName, $parentFieldSet);
    }

    /**
     * @param string $foreignTableName
     * @return Joint\Joint
     */
    public function joinTo($foreignTableName)
    {
        return $this->joints()
            ->joinTo($foreignTableName)
            ;
    }

    /**
     * @param bool $forceRealName
     * @param bool $enablePrefixMode
     * @return string
     */
    public function getName($forceRealName = false, $enablePrefixMode = false)
    {
        return $forceRealName && $enablePrefixMode
            ? $this->fieldPrefix.parent::getName($forceRealName)
            : parent::getName($forceRealName)
            ;
    }

    /**
     * @param string $prefix
     * @return $this
     */
    public function setFieldPrefix($prefix)
    {
        $this->fieldPrefix = $prefix;
        return $this;
    }

    /**
     * @return JointCollection
     */
    public function joints()
    {
        if(!self::$_joints) {
            self::$_joints = new JointCollection();
        }
        return self::$_joints->setParentFieldTmp($this);
    }

    /**
     * @param bool $enable
     * @return $this
     */
    public function enablePrimaryKey ($enable = true)
    {
        $this->primaryKey = $enable;
        return $this;
    }
}