<?php
/**
 * Class FileSystem
 * @author Leiha Sellier <leiha.sellier@gmail.com>
 * @link   https://github.com/leiha
 * -
 */

namespace Cube\FileSystem;

use Cube\Core\Configurator\Configurable\ConfigurableConfigurator;
use Cube\Core\Instance\Single\SingleBehavior;
use Cube\Dna\Gene\GeneConfiguratorInterface;
use Cube\Dna\Gene\GeneBehavior;

class FileSystem
    implements FileSystemInterface
{
    const DIRECTORY_ID_CACHE = 'cache';

    use FileSystemTrait;
    use GeneBehavior;
    use SingleBehavior;

    /**
     * @param ConfigurableConfigurator $configurator
     * @return mixed
     */
    public static function ____configureConfigurable(ConfigurableConfigurator $configurator)
    {
        // TODO: Implement ____configureConfigurable() method.
    }

    /**
     * @param FileSystemConfigurator $configurator
     * @return mixed
     */
    public static function ____configureFileSystem(FileSystemConfigurator $configurator)
    {
        // TODO: Implement ____configureFileSystem() method.
    }

    /**
     * @param GeneConfiguratorInterface $configurator
     * @return mixed
     */
    public static function ____configureGene(GeneConfiguratorInterface $configurator)
    {
        $configurator
            ->setUniqueName('cube.fileSystem')
        ;
    }
}