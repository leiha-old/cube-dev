<?php
/**
 * Created by PhpStorm.
 * User: lia
 * Date: 23/10/15
 * Time: 04:42
 */

namespace Cube\Validator;


class ValidatorGene
    extends ValidatorWrapper
{
    /**
     * @return string
     */
    protected function ____getClassOfValidator()
    {
        return Validator::Validator;
    }

    /**
     * @return string
     */
    protected function ____getClassOfField()
    {
        return Validator::Field;
    }
}