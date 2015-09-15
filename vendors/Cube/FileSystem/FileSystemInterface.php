<?php
/**
 * Class FileSystem
 * @author Leiha Sellier <leiha.sellier@gmail.com>
 * @link   https://github.com/leiha
 * -
 */

namespace Cube\FileSystem;

use Cube\Dna\Gene\GeneInterface;

interface FileSystemInterface
    extends GeneInterface
{
    /**
     * @param FileSystemConfigurator $configurator
     * @return mixed
     */
    public static function ____configureFileSystem(FileSystemConfigurator $configurator);
}