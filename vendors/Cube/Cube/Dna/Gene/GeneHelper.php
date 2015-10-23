<?php
/**
 * Created by PhpStorm.
 * User: lia
 * Date: 23/10/15
 * Time: 05:50
 */

namespace Cube\Dna\Gene;

use Cube\Poo\Mapper\Mappable\MappableHelper;

trait GeneHelper
{
    use MappableHelper;

    public static function single() {
        return static::singleTo(get_called_class().'Gene', func_get_args());
    }
}