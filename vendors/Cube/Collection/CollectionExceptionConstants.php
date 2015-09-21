<?php
/**
 * Class CollectionExceptionConstants
 * @author Leiha Sellier <leiha.sellier@gmail.com>
 * @link   https://github.com/leiha
 * -
 */

namespace Cube\Collection;

interface CollectionExceptionConstants
{
    const ERROR_DATA_ERROR = 'Data Error';

    const ERROR_ITEM_404 =
        'Entry [ :itemKey: ] not present ! '
        .'If you want to skip this message, put [ true ] on the second argument of get method'
    ;

    const ERROR_ITEM_DUPLICATE =
        'Entry [ :itemKey: ] already present, adding impossible !'
        .'If you want to skip this message, put [ true ] on the third argument of set method'
    ;

    const ERROR_RAIL_404 =
        'Entry [ item:railProgression: ] not present ! '
        .'If you want to skip this message, put [ true ] on the second argument of get method'
    ;

    const ERROR_RAIL_DUPLICATE =
        'Entry [ item:railProgression: ] already present, adding impossible !'
        .'If you want force this action, put [ true ] on the third argument of set method'
    ;
}