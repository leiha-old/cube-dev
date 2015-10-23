<?php
/**
 * Created by PhpStorm.
 * User: lia
 * Date: 17/09/15
 * Time: 12:58
 */

namespace Cube\Validator\Constraint;

use Cube\Poo\Error\Error;

class Constraint
    implements ConstraintConstants
{
    /**
     * @var array
     */
    protected static $factory = array(
        self::Mac        => 'Cube\Validator\Constraint\MacConstraint',    // >= PHP 5.5
        self::Email      => 'Cube\Validator\Constraint\EmailConstraint',
        self::Float      => 'Cube\Validator\Constraint\FloatConstraint',
        self::Int        => 'Cube\Validator\Constraint\IntConstraint',
        self::Ip         => 'Cube\Validator\Constraint\IpConstraint',
        self::Regexp     => 'Cube\Validator\Constraint\RegExpConstraint',
        self::Url        => 'Cube\Validator\Constraint\UrlConstraint',
        self::String     => 'Cube\Validator\Constraint\StringConstraint',
        self::Boolean    => 'Cube\Validator\Constraint\BooleanConstraint',
        self::Timestamp  => 'Cube\Validator\Constraint\TimeStampConstraint',
        self::Date       => 'Cube\Validator\Constraint\DateConstraint',
        self::Restricted => 'Cube\Validator\Constraint\RestrictedValuesConstraint',
    );

    /**
     * @param $type
     * @param array $data
     * @return ConstraintError
     */
    public static function error($type, array $data = array())
    {
        return ConstraintError::single($type, $data);
    }

    /**
     * @param array $constraints
     * @param string $value
     * @return array|null
     * @throws ConstraintError
     */
    public static function run(array $constraints, &$value)
    {
        /**
         * @var string             $constraintName
         * @var array              $options
         * @var ConstraintBehavior $constraint
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
     * @throws ConstraintError
     */
    public static function has($constraintName, $silent = false) {
        $is = array_key_exists($constraintName, static::$factory);
        if(!$is && !$silent) {
            throw static::error(Error::TYPE_404, compact('constraintName'));
        }
        return $is;
    }

    /**
     * @param string $constraintName Constraint::*
     * @param bool $silent
     * @return mixed
     * @throws ConstraintError
     */
    public static function get($constraintName = Constraint::String, $silent = false)
    {
        $is = self::has($constraintName, $silent);
        if($is) {
            $className = static::$factory[$constraintName];
            return new $className();
        }
        return $is;
    }
}