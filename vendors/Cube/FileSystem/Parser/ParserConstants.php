<?php
/**
 * Class ParserConstants
 * @author Leiha Sellier <leiha.sellier@gmail.com>
 * @link   https://github.com/leiha
 * -
 */

namespace Cube\FileSystem\Parser;

interface ParserConstants
{
	const PATTERN_CUBE_file = '/(.+\/(.[^\/]+)\/\2)\.php$/';
}