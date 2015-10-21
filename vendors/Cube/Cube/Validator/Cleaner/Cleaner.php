<?php

namespace Cube\Validator\Cleaner;

use Cube\Validator\Tool\FilterVarAbstract;

class Cleaner
    implements CleanerConstants
{
    /**
     * @var array
     */
    protected static $factory = array(
        self::CLEANER_email    => 'Cube\Validator\Cleaner\EmailCleaner',
        self::CLEANER_encoded  => 'Cube\Validator\Cleaner\EncodedCleaner',
        self::CLEANER_quotes   => 'Cube\Validator\Cleaner\QuotesCleaner',
        self::CLEANER_float    => 'Cube\Validator\Cleaner\FloatCleaner',
        self::CLEANER_int      => 'Cube\Validator\Cleaner\IntCleaner',
        self::CLEANER_chars    => 'Cube\Validator\Cleaner\CharsCleaner',
        self::CLEANER_charsf   => 'Cube\Validator\Cleaner\CharsFCleaner',
        self::CLEANER_string   => 'Cube\Validator\Cleaner\StringCleaner',
        self::CLEANER_stripped => 'Cube\Validator\Cleaner\StrippedCleaner',
        self::CLEANER_url      => 'Cube\Validator\Cleaner\UrlCleaner',
        self::CLEANER_unsafe   => 'Cube\Validator\Cleaner\UnsafeCleaner',
    );

    /**
     * @param $type
     * @param array $data
     * @return CleanerException
     */
    public static function exception($type, array $data = array()) {
        return new CleanerException($type, $data);
    }

    /**
     * @param array $cleaners
     * @param string $value
     * @return array|null
     * @throws CleanerException
     */
    public static function run (array $cleaners, &$value)
    {
        /**
         * @var string            $cleanerName
         * @var array             $options
         * @var FilterVarAbstract $cleaner
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
     * @throws CleanerException
     */
    public static function has ($cleanerName, $silent = false) {
        $is = isset(static::$factory[$cleanerName]);
        if(!$is && !$silent) {
            throw static::exception(CleanerException::TYPE_NOT_FOUND, compact('cleanerName'));
        }
        return $is;
    }

    /**
     * @param string $cleanerName Cleaner::CLEANER_*
     * @param bool $silent
     * @return mixed
     * @throws CleanerException
     */
    public static function get($cleanerName = self::CLEANER_string, $silent = false)
    {
        if(!$silent && !isset(static::$factory[$cleanerName])) {
            throw static::exception(CleanerException::TYPE_NOT_FOUND, compact('cleanerName'));
        }

        $className = static::$factory[$cleanerName];
        return new $className();
    }
}