<?php
/**
 * Created by PhpStorm.
 * User: lia
 * Date: 23/09/15
 * Time: 14:17
 */

namespace Cube\Db\Table\Field\Joint;

use Cube\Db\Table\Field\Field;
use Cube\Db\Table\Table;

class Joint
{
    const CLAUSE_ON_local    = 'local';
    const CLAUSE_ON_operator = 'operator';
    const CLAUSE_ON_foreign  = 'foreign';

    /**
     * @var Table
     */
    private $foreignTable;

    /**
     * @var JointCollection
     */
    private $parentCollection;

    /**
     * @var Field
     */
    private $parentField;

    /**
     * @var string
     */
    private $clauseOn  = '';

    /**
     * @var array
     */
    private $clausesOn = array();

    /**
     * @var array
     */
    private $clausesSelect = array();

    /**
     * @param string          $foreignTableName
     * @param Field           $parentField
     * @param JointCollection $parentCollection
     */
    public function __construct($foreignTableName, Field $parentField, JointCollection $parentCollection)
    {
        $this->parentField      = $parentField;
        $this->foreignTable     = Table::get($foreignTableName);
        $this->parentCollection = $parentCollection;
    }

    /**
     * @return JointCollection
     */
    public function end()
    {
        return $this->parentCollection;
    }

    /**
     * @param string $localField
     * @param string $foreignField
     * @param string $operator
     * @return $this
     */
    public function addClauseOn($foreignField, $localField = '', $operator= '=')
    {
        $this->clausesOn[] = array(
            self::CLAUSE_ON_local    => $localField,
            self::CLAUSE_ON_foreign  => $this->foreignTable->getField($foreignField),
            self::CLAUSE_ON_operator => $operator
        );
        return $this;
    }

    /**
     * @param string $clause
     * @return $this
     */
    public function setClauseOn($clause)
    {
        $this->clauseOn = $clause;
        return $this;
    }

    /**
     * @param string $foreignField
     * @return $this
     */
    public function addClauseSelect($foreignField)
    {
        $this->clausesSelect[] = $this->foreignTable->getField($foreignField);
        return $this;
    }
}