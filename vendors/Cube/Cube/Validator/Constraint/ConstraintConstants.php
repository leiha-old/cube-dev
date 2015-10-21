<?php
/**
 * Created by PhpStorm.
 * User: lia
 * Date: 22/09/15
 * Time: 16:30
 */

namespace Cube\Validator\Constraint;

use Cube\Validator\FieldSet\Field\FieldConstants;

interface ConstraintConstants
    extends FieldConstants
{

    const ERROR_TYPE_404         = 'Constraint [ :constraintName: ] not present !';

    /**
     * @var MacConstraint|string
     */
    const CONSTRAINT_mac         = self::TYPE_mac;

    /**
     * @var EmailConstraint|string
     */
    const CONSTRAINT_email       = self::TYPE_email;

    /**
     * @var FloatConstraint|string
     */
    const CONSTRAINT_float       = self::TYPE_float;

    /**
     * @var IntConstraint|string
     */
    const CONSTRAINT_int         = self::TYPE_int;

    /**
     * @var IpConstraint|string
     */
    const CONSTRAINT_ip          = self::TYPE_ip;

    /**
     * @var RegExpConstraint|string
     */
    const CONSTRAINT_regexp      = self::TYPE_regexp;

    /**
     * @var UrlConstraint|string
     */
    const CONSTRAINT_url         = self::TYPE_url;

    /**
     * @var StringConstraint|string
     */
    const CONSTRAINT_string      = self::TYPE_string;

    /**
     * @var BooleanConstraint|string
     */
    const CONSTRAINT_boolean     = self::TYPE_boolean;

    /**
     * @var TimeStampConstraint|string
     */
    const CONSTRAINT_timestamp   = self::TYPE_timestamp;

    /**
     * @var DateConstraint|string
     */
    const CONSTRAINT_date        = self::TYPE_date;

    /**
     * @var RestrictedValuesConstraint|string
     */
    const CONSTRAINT_restricted  = self::TYPE_restricted;
}