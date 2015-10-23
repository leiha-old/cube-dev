<?php
/**
 * Created by PhpStorm.
 * User: lia
 * Date: 22/09/15
 * Time: 16:31
 */

namespace Cube\Validator\Cleaner;

use Cube\Validator\Type\Type;

interface CleanerConstants
{
    const Email        = Type::Email;
    const Encoded      = 'encoded';
    const Quotes       = 'magic_quotes';
    const Float        = 'number_float';
    const Int          = 'number_int';
    const Chars        = 'special_chars';
    const Charsf       = 'full_special_chars';
    const String       = Type::String;
    const Stripped     = 'stripped';
    const Url          = Type::Url;
    const Unsafe       = 'unsafe_raw';
}