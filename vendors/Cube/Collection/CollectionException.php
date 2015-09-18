<?php
/**
 * Class CollectionException
 * @author Leiha Sellier <leiha.sellier@gmail.com>
 * @link   https://github.com/leiha
 * -
 */

namespace Cube\Collection;

use Cube\Poo\Exception\Exception;

class CollectionException
    extends Exception
{
    const ITEM_404 =
         'Entry [ :itemKey: ] not present ! '
        .'If you want to skip this message, put [ true ] on the second argument of get method'
    ;

    const ITEM_DUPLICATE =
        'Entry [ :itemKey: ] already present, adding impossible !'
        .'If you want to skip this message, put [ true ] on the third argument of set method'
    ;

    const RAIL_404 =
         'Entry [ item:railProgression: ] not present ! '
        .'If you want to skip this message, put [ true ] on the second argument of get method'
    ;

    const RAIL_DUPLICATE =
         'Entry [ item:railProgression: ] already present, adding impossible !'
        .'If you want force this action, put [ true ] on the third argument of set method'
        ;
}