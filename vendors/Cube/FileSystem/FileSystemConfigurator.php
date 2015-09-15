<?php
/**
 * Class FileSystemConfigurator
 * @author Leiha Sellier <leiha.sellier@gmail.com>
 * @link   https://github.com/leiha
 * -
 */

namespace Cube\FileSystem;

use Cube\Collection\CollectionBehavior;

class FileSystemConfigurator
{
    use CollectionBehavior {
        get as protected;
        set as protected;
        __construct as private __constructCollection;
    }

    public function __construct(){
        $this->__constructCollection(array(
            'directory' => array(
                FileSystem::DIRECTORY_ID_CACHE  => 'cache'
            )
        ));
    }
}