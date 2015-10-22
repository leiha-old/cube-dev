<?php

namespace Cube\Validator\FieldSet;

use Cube\Validator\Cleaner\CleanerConstants;
use Cube\Validator\Constraint\ConstraintConstants;
use Cube\Validator\Constraint\ConstraintException;
use Cube\Validator\FieldSet\Field\Field;
use Cube\Validator\FieldSet\Field\FieldConstants;

class FieldSet
    implements FieldConstants,
               ConstraintConstants,
               CleanerConstants
{
    const CLASS_fieldSet = 'Cube\Validator\FieldSet\FieldSet';
    const CLASS_field    = 'Cube\Validator\FieldSet\Field\Field';

    use FieldSetHelper;
}