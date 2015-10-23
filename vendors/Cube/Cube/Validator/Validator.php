<?php

namespace Cube\Validator;

use Cube\Validator\Cleaner\CleanerConstants;
use Cube\Validator\Constraint\ConstraintConstants;
use Cube\Validator\Field\FieldConstants;

class Validator
{
    const CLASS_fieldSet = 'Cube\Validator\FieldSet\FieldSet';
    const CLASS_field    = 'Cube\Validator\FieldSet\Field\Field';

    use ValidatorHelper;

    /**
     * @var Validator[]
     */
    private static $_fieldSets = array();

    /**
     * @param string $fieldSetName
     * @return Validator
     */
    public static function get($fieldSetName)
    {
        if(!array_key_exists($fieldSetName, self::$_fieldSets)) {
            if(class_exists($fieldSetName)
                && is_subclass_of($fieldSetName, Validator::CLASS_fieldSet)
            ) {
                self::$_fieldSets[$fieldSetName] = new $fieldSetName();
            }
            else {
                return null;
            }
        }
        return self::$_fieldSets[$fieldSetName];
    }
}