<?php
/**
 * Created by PhpStorm.
 * User: lia
 * Date: 22/09/15
 * Time: 16:31
 */

namespace Cube\Validator\Cleaner;

interface CleanerConstants
{
    const CLEANER_email        = 'email';
    const CLEANER_encoded      = 'encoded';
    const CLEANER_quotes       = 'magic_quotes';
    const CLEANER_float        = 'number_float';
    const CLEANER_int          = 'number_int';
    const CLEANER_chars        = 'special_chars';
    const CLEANER_charsf       = 'full_special_chars';
    const CLEANER_string       = 'string';
    const CLEANER_stripped     = 'stripped';
    const CLEANER_url          = 'url';
    const CLEANER_unsafe       = 'unsafe_raw';
}