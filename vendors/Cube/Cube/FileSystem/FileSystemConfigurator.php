<?php
/**
 * Class FileSystemConfigurator
 * @author Leiha Sellier <leiha.sellier@gmail.com>
 * @link   https://github.com/leiha
 * -
 */

namespace Cube\FileSystem;

use Cube\Collection\CollectionHelper;

class FileSystemConfigurator
{
    use CollectionHelper {
	    set as protected;
	    __construct as private __constructCollection;
    }

    public function __construct(){
        $this->__constructCollection(array(
            'includePaths' => array(),
            'directory'    => array(
                FileSystem::DIRECTORY_cacheId  => 'cache'
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