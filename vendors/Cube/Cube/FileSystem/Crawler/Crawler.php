<?php
/**
 * Class Crawler
 * @author Leiha Sellier <leiha.sellier@gmail.com>
 * @link   https://github.com/leiha
 * -
 */

namespace Cube\FileSystem\Crawler;

use Cube\FileSystem\AutoLoader\AutoLoader;
use Cube\FileSystem\AutoLoader\AutoLoaderError;
use Cube\FileSystem\FileSystem;
use Cube\Poo\Mapper\Mappable\Mappable;

class Crawler
    extends    Mappable
	implements CrawlerConstants
{
    /**
     * @var array
     */
    private $parts;

    /**
     * @var FileSystem
     */
    private $fileSystem;

    private $locations = array('Cache\\', 'Override\\', '');

    public function __construct(FileSystem $fileSystem)
    {
        $this->fileSystem = $fileSystem;
        $this->parts      = array(
            'Constants'     => array(
                'found'    => false,
            ),
            'Service'       => array(
                'found'    => false,
            ),
            'ServiceHelper' => array(
                'found'    => false,
            ),
            'Facade'  => array(
                'found'    => false,
                'callback' => function ($className, $classConfigurator) {
                    //Mapper::single()->setConfiguratorTo($className, $classConfigurator);
                },
            ),
            'Behavior'      => array(
                'found'    => false,
            ),
            'Helper'        => array(
                'found'    => false,
            ),
            'Interface'     => array(
                'found'    => false,
            ),
            'Error'     => array(
                'found'    => false,
            )
        );
    }

    public function findClasses() {

        $classes = array();
        $parts   = $this->parts;

        /**
         * @param \DirectoryIterator $item
         * @param $includePath
         * @throws AutoLoaderError
         */
        $parser = function(\DirectoryIterator $item, $includePath)
            use (&$parts, &$classes)
        {
            $name  = $item->getRealPath();

            if(preg_match(Crawler::PATTERN_CUBE_class, $name, $matches)){
                $class = str_replace(DIRECTORY_SEPARATOR, '\\', substr($matches[1], strlen($includePath)));
                $this->retrieveRealClass($class, $classes);
            }

//            if(preg_match(Crawler::PATTERN_CUBE_template, $name, $matches)){
//                $class = str_replace(DIRECTORY_SEPARATOR, '\\', substr($matches[1], strlen($includePath)));
//                $this->retrieveRealClass($class, $classes);
//            }

            // if files present like this : xxxx/Cube/Cube.php
            if(preg_match(Crawler::PATTERN_CUBE_object, $name, $matches)){
                $class = str_replace(DIRECTORY_SEPARATOR, '\\', substr($matches[1], strlen($includePath)));
                $this->retrieveParts($class, $parts, $classes);
            }
        };

        $this->fileSystem->iterateIncludePaths($parser);
        return $classes;
    }

    /**
     * @param string $class
     * @param array  $classes
     * @throws AutoLoaderError
     */
    protected function retrieveRealClass($class, array &$classes)
    {
        foreach($this->locations as $location) {
            $oClass =  $location . $class;
            if (AutoLoader::loadClass($oClass)) {
                $classes[$class] = array();
                $classes[$class]['Class'] = $oClass;
                return;
            }
        }
    }

    /**
     * @param string $class
     * @param array  $parts
     * @param array  $classes
     * @throws AutoLoaderError
     */
    protected function retrieveParts($class, array $parts, array &$classes)
    {
        foreach($parts as $part => &$partConfig) {
            $classService = $class.$part;
            foreach($this->locations as $location) {
                $oClass = $location.$classService;
                if(!$partConfig['found'] && AutoLoader::loadClass($oClass)) {
                    $classes[$class][$part] = $oClass;
                    $partConfig['found']    = true;
                    if(array_key_exists('callback', $partConfig)
                        && is_callable($partConfig['callback'])
                    ) {
                        $partConfig['callback']($class, $classService);
                    }
                }
            }
        }
    }
}