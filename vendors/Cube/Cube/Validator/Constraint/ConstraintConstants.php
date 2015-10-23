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
    const Mac         = Field::TYPE_mac;

    /**
     * @var EmailConstraint|string
     */
    const Email       = Field::TYPE_email;

    /**
     * @var FloatConstraint|string
     */
    const Float       = Field::TYPE_float;

    /**
     * @var IntConstraint|string
     */
    const Int         = Field::TYPE_int;

    /**
     * @var IpConstraint|string
     */
    const Ip          = Field::TYPE_ip;

    /**
     * @var RegExpConstraint|string
     */
    const Regexp      = Field::TYPE_regexp;

    /**
     * @var UrlConstraint|string
     */
    const Url         = Field::TYPE_url;

    /**
     * @var StringConstraint|string
     */
    const String      = Field::TYPE_string;

    /**
     * @var BooleanConstraint|string
     */
    const Boolean     = Field::TYPE_boolean;

    /**
     * @var TimeStampConstraint|string
     */
    const Timestamp   = Field::TYPE_timestamp;

    /**
     * @var DateConstraint|string
     */
    const Date        = Field::TYPE_date;

    /**
     * @var RestrictedValuesConstraint|string
     */
    const Restricted  = Field::TYPE_restricted;
}