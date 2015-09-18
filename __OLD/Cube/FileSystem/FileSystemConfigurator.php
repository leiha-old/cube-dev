<?php
/**
 * Class FileSystemConfigurator
 * @author Leiha Sellier <leiha.sellier@gmail.com>
 * @link   https://github.com/leiha
 * -
 */

namespace OLD\Cube\FileSystem;

use Cube\Collection\CollectionBehavior;
use Cube\Core\Instance\InstanceBehavior;

class FileSystemConfigurator
{
    use InstanceBehavior;

    use CollectionBehavior {
        get as protected;
        set as protected;
        __construct as private __constructCollection;
    }

    /**
     * @var array
     */
    private $includePaths;

    public function __construct(){
        $this->__constructCollection(array(
            'includePaths' => array(),
            'directory'    => array(
                FileSystem::DIRECTORY_ID_CACHE  => 'cache'
            )
        ));
    }

    /**
     * @param array $includePaths
     * @return $this
     */
    public function setIncludePaths(array $includePaths)
    {
        return $this->set('includePaths', $includePaths);
    }

    public function getIncludePaths()
    {
        return $this->get('includePaths');
    }
}