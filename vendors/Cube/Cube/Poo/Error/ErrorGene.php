<?php
/**
 * Created by PhpStorm.
 * User: lia
 * Date: 23/10/15
 * Time: 05:17
 */

namespace Cube\Poo\Error;

use Cube\Poo\Mapper\Mappable\MappableHelper;

class ErrorGene
    extends ErrorWrapper
    implements ErrorConstants
{
    use MappableHelper;

    /**
     * @param \Exception $error
     * @return $this
     */
    public static function forward(\Exception $error) {
    $e = new static($error->getMessage());
    return $e;
}
}