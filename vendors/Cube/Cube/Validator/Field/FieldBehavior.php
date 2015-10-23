<?php
/**
 * Created by PhpStorm.
 * User: lia
 * Date: 29/09/15
 * Time: 11:37
 */

namespace Cube\Validator\Field;

use Cube\Validator\Cleaner\Cleaner;
use Cube\Validator\Cleaner\CleanerError;
use Cube\Validator\Constraint\Constraint;
use Cube\Validator\Constraint\ConstraintError;

interface FieldBehavior
{
    /**
     * @param mixed $value
     * @return $this
     */
    public function setDefaultValue($value);

    /**
     * @param mixed $value
     * @param array $errors
     * @throws ConstraintError
     * @throws CleanerError
     * @return boolean
     */
    public function validate(&$value, &$errors);

    /**
     * @param string $value1
     * @throws ConstraintError
     * @return $this
     */
    public function addAllowedValues($value1 /* , value2, value2, .etc.. */);

    /**
     * @param string $constraintName
     * @param \closure|null $cb
     * @return $this|false
     * @throws \Cube\Validator\Constraint\ConstraintError
     */
    public function addConstraint($constraintName = Constraint::String, \closure $cb = null);

    /**
     * @param string $cleanerName (Field | Validator)::CLEANER_*
     * @param array  $options
     * @throws CleanerError
     * @return $this
     */
    public function addCleaner($cleanerName = Cleaner::String, array $options = array());

    /**
     * @return string
     */
    public function getType();

    /**
     * @param string $type (Field | Validator)::TYPE_*
     * @return $this
     */
    public function setType($type = Field::TYPE_string);

    /**
     * @param string $alias
     * @return $this
     */
    public function setAlias($alias);

    /**
     * @param bool $enable
     * @return $this
     */
    public function enableRequired($enable = true);

    /**
     * @return bool
     */
    public function isRequired();

    /**
     * @return string
     */
    public function getAlias();

    /**
     * @param bool $forceRealName
     * @return string
     */
    public function getName($forceRealName = false);

    /**
     * @return string
     */
    public function getDefaultValue();
}