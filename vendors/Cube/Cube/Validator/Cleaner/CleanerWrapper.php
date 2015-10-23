<?php
/**
 * Created by PhpStorm.
 * User: lia
 * Date: 22/10/15
 * Time: 23:31
 */

namespace Cube\Validator\Cleaner;

use Cube\Poo\Wrapper\Wrapper;

abstract class CleanerWrapper
    extends Wrapper
{
    /**
     * @var array
     */
    protected static $factory = array(
        Cleaner::Email    => 'Cube\Validator\Cleaner\EmailCleaner',
        Cleaner::Encoded  => 'Cube\Validator\Cleaner\EncodedCleaner',
        Cleaner::Quotes   => 'Cube\Validator\Cleaner\QuotesCleaner',
        Cleaner::Float    => 'Cube\Validator\Cleaner\FloatCleaner',
        Cleaner::Int      => 'Cube\Validator\Cleaner\IntCleaner',
        Cleaner::Chars    => 'Cube\Validator\Cleaner\CharsCleaner',
        Cleaner::Charsf   => 'Cube\Validator\Cleaner\CharsFCleaner',
        Cleaner::String   => 'Cube\Validator\Cleaner\StringCleaner',
        Cleaner::Stripped => 'Cube\Validator\Cleaner\StrippedCleaner',
        Cleaner::Url      => 'Cube\Validator\Cleaner\UrlCleaner',
        Cleaner::Unsafe   => 'Cube\Validator\Cleaner\UnsafeCleaner',
    );

    /**
     * @param $type
     * @param array $data
     * @return CleanerError
     */
    public static function error($type, array $data = array()) {
        return new CleanerError($type, $data);
    }

    /**
     * @param array $cleaners
     * @param string $value
     * @return array|null
     * @throws CleanerError
     */
    public static function run (array $cleaners, &$value)
    {
        /**
         * @var string            $cleanerName
         * @var array             $options
         * @var CleanerBehavior $cleaner
         */

        foreach($cleaners as $cleanerName => $options) {
            $cleaner = static::get($cleanerName);
            $value = $cleaner->run($value, $options);
        }

        return $value;
    }

    /**
     * @param string $cleanerName
     * @param bool $silent
     * @return mixed
     * @throws CleanerError
     */
    public static function has ($cleanerName, $silent = false) {
        $is = array_key_exists($cleanerName, static::$factory);
        if(!$is && !$silent) {
            throw static::error(Cleaner::Error_, compact('cleanerName'));
        }
        return $is;
    }

    /**
     * @param string $cleanerName Cleaner::CLEANER_*
     * @param bool $silent
     * @return mixed
     * @throws CleanerError
     */
    public static function get($cleanerName = Cleaner::String, $silent = false)
    {
        if(!$silent && !array_key_exists($cleanerName, static::$factory)) {
            throw static::error(CleanerError::TYPE_NOT_FOUND, compact('cleanerName'));
        }

        $className = static::$factory[$cleanerName];
        return new $className();
    }
}