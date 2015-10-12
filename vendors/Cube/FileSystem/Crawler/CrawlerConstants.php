<?php
/**
 * Class CrawlerConstants
 * @author Leiha Sellier <leiha.sellier@gmail.com>
 * @link   https://github.com/leiha
 * -
 */

namespace Cube\FileSystem\Crawler;

interface CrawlerConstants
{

	const PATTERN_CUBE_class    = '/(.+\/(.[^\/\.]+))\.php$/';

    const PATTERN_CUBE_object   = '/(.+\/(.[^\/\.]+)\/\2)\.php$/';

    const PATTERN_CUBE_template = '/([[:alnum:]\-_\/]+)\/([[:alnum:]\/]+)\.block\.php$/';

}