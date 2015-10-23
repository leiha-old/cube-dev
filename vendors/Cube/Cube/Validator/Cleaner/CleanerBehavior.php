<?php
/**
 * Created by PhpStorm.
 * User: lia
 * Date: 23/10/15
 * Time: 00:07
 */

namespace Cube\Validator\Cleaner;


interface CleanerBehavior
{
    /**
     * @param $type
     * @param array $data
     * @return CleanerError
     */
    public static function error($type, array $data = array());

    /**
     * @param array $cleaners
     * @param string $value
     * @return array|null
     * @throws CleanerError
     */
    public static function run (array $cleaners, &$value);

    /**
     * @param string $cleanerName
     * @param bool $silent
     * @return mixed
     * @throws CleanerError
     */
    public static function has ($cleanerName, $silent = false);

    /**
     * @param string $cleanerName Const Cleaner::*
     * @param bool $silent
     * @return mixed
     * @throws CleanerError
     */
    public static function get($cleanerName = Cleaner::String, $silent = false);
}