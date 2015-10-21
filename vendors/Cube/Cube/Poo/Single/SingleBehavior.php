<?php
/**
 * Created by PhpStorm.
 * User: lia
 * Date: 15/10/15
 * Time: 19:00
 */

namespace Cube\Poo\Single;


interface SingleBehavior
{
    /**
     * @return static
     */
    public static function single();
}