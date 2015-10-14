<?php

namespace Cube\Collection;

interface CollectionConstants
{
    const SORT_regular = SORT_REGULAR;

    const SORT_numeric = SORT_NUMERIC;

    const SORT_string  = SORT_STRING;

    const SORT_natural = SORT_NATURAL;

	const ERROR_DATA_ERROR = 'Data Error';

	const ERROR_ITEM_404 =
		'Entry [ :itemKey: ] not present !
		If you want to skip this message, put [ true ] on the second argument of get method'
	;

	const ERROR_ITEM_duplicate =
		'Entry [ :itemKey: ] already present, adding impossible !
		If you want to skip this message, put [ true ] on the third argument of set method'
	;

	const ERROR_RAIL_404 =
		'Entry [ item:railProgression: ] not present !
		If you want to skip this message, put [ true ] on the second argument of get method'
	;

	const ERROR_RAIL_duplicate =
		'Entry [ item:railProgression: ] already present, adding impossible !
		If you want force this action, put [ true ] on the third argument of set method'
	;
}