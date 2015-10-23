<?php
/**
 * Created by PhpStorm.
 * User: lia
 * Date: 23/10/15
 * Time: 04:59
 */

namespace Cube\Validator;

use Cube\Validator\Constraint\ConstraintError;
use Cube\Validator\Field\Field;
use Cube\Validator\Type\Type;

interface ValidatorBehavior
{
    /**
     * @return string
     */
    public function getName();

    /**
     * @param bool $includeGroups
     * @return array
     */
    public function getAllValues($includeGroups = true);

    /**
     * @param string $groupName
     * @param array  $values
     * @param array  $errors
     * @return boolean
     */
    public function validateGroupValues($groupName, array $values, &$errors);

    /**
     * @param array $values
     * @param array $errors
     * @param bool $includeGroups
     * @return bool
     */
    public function validateValues(array $values, &$errors, $includeGroups = true);

    /**
     * @param string $fieldId
     * @param Field  $field
     * @param mixed  $value
     * @param array  $errors
     * @return bool
     */
    public function validateValue($fieldId, Field $field, $value, &$errors);

    /**
     * @param $groupName
     * @return Validator
     */
    public function addGroup($groupName);

    /**
     * @param string $fieldName
     * @param mixed $defaultValue
     * @param string $type          Type::*
     * @throws ConstraintError
     * @return Field
     */
    public function addField($fieldName, $defaultValue = null, $type = Type::String);

    /**
     * @param string $groupName
     * @return Validator
     */
    public function getGroup($groupName);

    /**
     * @param string $fieldName
     * @return Field
     */
    public function getField($fieldName);
}