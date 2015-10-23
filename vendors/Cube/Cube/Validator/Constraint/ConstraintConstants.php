<?php
/**
 * Created by PhpStorm.
 * User: lia
 * Date: 22/09/15
 * Time: 16:30
 */

namespace Cube\Validator\Constraint;

use Cube\Validator\Field\Field;

interface ConstraintConstants
{
    /**
     * @var MacConstraint|string
     */
    const Mac         = Field::Mac;

    /**
     * @var EmailConstraint|string
     */
    const Email       = Field::Email;

    /**
     * @var FloatConstraint|string
     */
    const Float       = Field::Float;

    /**
     * @var IntConstraint|string
     */
    const Int         = Field::Int;

    /**
     * @var IpConstraint|string
     */
    const Ip          = Field::Ip;

    /**
     * @var RegExpConstraint|string
     */
    const Regexp      = Field::Regexp;

    /**
     * @var UrlConstraint|string
     */
    const Url         = Field::Url;

    /**
     * @var StringConstraint|string
     */
    const String      = Field::String;

    /**
     * @var BooleanConstraint|string
     */
    const Boolean     = Field::Boolean;

    /**
     * @var TimeStampConstraint|string
     */
    const Timestamp   = Field::Timestamp;

    /**
     * @var DateConstraint|string
     */
    const Date        = Field::Date;

    /**
     * @var RestrictedValuesConstraint|string
     */
    const Restricted  = Field::Restricted;
}