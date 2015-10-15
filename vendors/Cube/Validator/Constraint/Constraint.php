<?php
/**
 * Created by PhpStorm.
 * User: lia
 * Date: 17/09/15
 * Time: 12:58
 */

namespace Cube\Validator\Constraint;

use Cube\Validator\Tool\FilterVarAbstract;

class Constraint
    implements ConstraintConstants
{
    /**
     * @var array
     */
    protected static $factory = array(
        self::CONSTRAINT_mac        => 'Cube\Validator\Constraint\MacConstraint',    // >= PHP 5.5
        self::CONSTRAINT_email      => 'Cube\Validator\Constraint\EmailConstraint',
        self::CONSTRAINT_float      => 'Cube\Validator\Constraint\FloatConstraint',
        self::CONSTRAINT_int        => 'Cube\Validator\Constraint\IntConstraint',
        self::CONSTRAINT_ip         => 'Cube\Validator\Constraint\IpConstraint',
        self::CONSTRAINT_regexp     => 'Cube\Validator\Constraint\RegExpConstraint',
        self::CONSTRAINT_url        => 'Cube\Validator\Constraint\UrlConstraint',
        self::CONSTRAINT_string     => 'Cube\Validator\Constraint\StringConstraint',
        self::CONSTRAINT_boolean    => 'Cube\Validator\Constraint\BooleanConstraint',
        self::CONSTRAINT_timestamp  => 'Cube\Validator\Constraint\TimeStampConstraint',
        self::CONSTRAINT_date       => 'Cube\Validator\Constraint\DateConstraint',
        self::CONSTRAINT_restricted => 'Cube\Validator\Constraint\RestrictedValuesConstraint',
    );

    /**
     * @param $type
     * @param array $data
     * @return ConstraintException
     */
    public static function exception($type, array $data = array())
    {
        return new ConstraintException($type, $data);
    }

    /**
     * @param array $constraints
     * @param string $value
     * @return array|null
     * @throws ConstraintException
     */
    public static function run(array $constraints, &$value)
    {
        /**
         * @var string            $constraintName
         * @var array             $options
         * @var FilterVarAbstract $constraint
         */

        $errors = array();
        foreach($constraints as $constraintName => $options) {
            $constraint = static::get($constraintName);
            if(false === $constraint->run($value, $options)) {
                $errors[$constraintName] = true;
            }
        }

        return count($errors) ? $errors : null;
    }

    /**
     * @param string $constraintName
     * @param bool $silent
     * @return mixed
     * @throws ConstraintException
     */
    public static function has($constraintName, $silent = false) {
        $is = isset(static::$factory[$constraintName]);
        if(!$is && !$silent) {
            throw static::exception(self::ERROR_TYPE_404, compact('constraintName'));
        }
        return $is;
    }

    /**
     * @param string $constraintName Constraint::CONSTRAINT_*
     * @param bool $silent
     * @return mixed
     * @throws ConstraintException
     */
    public static function get($constraintName = self::CONSTRAINT_string, $silent = false)
    {
        $is = self::has($constraintName, $silent);
        if($is) {
            $className = static::$factory[$constraintName];
            return new $className();
        }
        return $is;
    }
}