<?php

namespace Cube\Validator\Field;

use Cube\Poo\Wrapper\Wrapper;
use Cube\Validator\Validator;

abstract class FieldWrapper
    extends    Wrapper
    implements FieldBehavior
{
    use FieldHelper;

    /**
     * @param string        $fieldName
     * @param object|string $wrapped
     * @param Validator     $parentValidator
     */
    public function __construct($fieldName, $wrapped, Validator $parentValidator = null)
    {
        parent::__constructWrapper($wrapped);
        $this->name           = $fieldName;
        $this->parentValidator = $parentValidator;
    }
}