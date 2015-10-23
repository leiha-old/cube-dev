<?php

namespace Cube\Validator\Field;

use Cube\Poo\Wrapper\Wrapper;
use Cube\Validator\Constraint\ConstraintConstants;
use Cube\Validator\Cleaner\CleanerConstants;
use Cube\Validator\Field\FieldBehavior;
use Cube\Validator\Field\FieldConstants;
use Cube\Validator\Field\FieldHelper;
use Cube\Validator\Validator;

abstract class FieldWrapper
    extends    Wrapper
    implements FieldBehavior,
               FieldConstants
{
    use FieldHelper;

    /**
     * @param string   $fieldName
     * @param Validator $parentValidator
     */
    public function __construct($fieldName, Validator $parentValidator = null)
    {
        parent::__construct($this);
        $this->name           = $fieldName;
        $this->parentValidator = $parentValidator;
    }
}