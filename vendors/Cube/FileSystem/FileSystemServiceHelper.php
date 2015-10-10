<?php

namespace Cube\FileSystem;

use Cube\FileSystem\AutoLoader\AutoLoader;
use Cube\FileSystem\AutoLoader\AutoLoaderException;
use Cube\FileSystem\Crawler\Crawler;
use Cube\Poo\Mapper\Mappable\MappableHelper;

trait FileSystemServiceHelper
{
    use MappableHelper;

	/**
	 * @var array
	 */
    private $includePaths;

	/**
	 * @param string $path
	 * @param \Closure $callback ($item, $path)
	 * @throws FileSystemException
	 */
	public static function iterateOn($path, \Closure $callback)
	{
		$iterator = new \DirectoryIterator ( $path );
		foreach($iterator as $item){
			if($item->isDot()) {
				continue;
			}

			if($item->isDir()) {
				static::iterateOn($item->getPathname(), $callback);
				continue;
			}

			$callback($item, $path);
		}
	}

    /**
     * @param array $includePaths
     */
    public function __construct(array $includePaths) {
        $this->includePaths = $includePaths;
    }

	/**
	 * @return Crawler
	 */
	public function crawler(){
		return Crawler::single($this);
	}

	/**
	 * @param string    $className
	 * @param bool      $silent
	 * @return bool
	 * @throws AutoLoaderException
	 */
	public function isClass($className, $silent = true) {
		return AutoLoader::loadClass($className, $silent);
	}

    /**
     * @param \Closure $cbForEachFile (\DirectoryIterator $item)
     */
    public function iterateIncludePaths(\Closure $cbForEachFile)
    {
        foreach($this->includePaths as $includePath) {
            $this->iterateOn($includePath,
	            function(\DirectoryIterator $item)
	                use ($includePath, $cbForEachFile)
	            {
	                $cbForEachFile($item, $includePath);
                }
            );
        }
    }
}