<?php

namespace Cube\FileSystem\AutoLoader;

AutoLoader::create('Cube', realpath(__DIR__.'/../../../').'/');

class AutoLoader
{
    /**
     * Return the NameSpace of the class for hybridization
     * @return string
     */
    public static function ___getClass()
    {
        // @Class Cube\AutoLoader
        return 'Cube\FileSystem\AutoLoader\AutoLoader';
    }

    /**
     * Return the NameSpace of the method for mutation
     * @param string $functionName
     * @return string
     */
    public static function ___getHook($functionName = 'autoload')
    {
        // @Method Cube\AutoLoader::autoload
        return self::___getClass().'::'.$functionName;
    }

    /**
     * @var array
     */
    private static $includePaths = array();

    /**
     * @var AutoLoader
     */
    private static $autoloader;

    /**
     * @param $name
     * @param $includePath
     * @return AutoLoader
     */
    static public function create($name, $includePath)
    {
        if (!self::$autoloader) {
            self::single();
            spl_autoload_register(self::___getHook(), true, true);
        }
        self::add($name, $includePath);
        return self::$autoloader;
    }

    /**
     * @return AutoLoader
     */
    static function single()
    {
        if (!self::$autoloader) {
            $className = self::___getClass();
            self::$autoloader = new $className();
        }
        return self::$autoloader;
    }

    /**
     * @return array
     */
    static public function getListOfIncludeFiles()
    {
        return self::$includePaths;
    }

    /**
     * @param string $path
     * @param bool $silent
     * @param string $extension
     * @return bool
     * @throws AutoLoaderException
     */
    static public function loadFile($path, $silent = false, $extension = '.php')
    {
        $is = is_file($file = $path . $extension);
        if ($is) {
            require_once($file);
        } elseif (!$silent) {
            // @Throw AutoLoaderException
            throw new AutoLoaderException(AutoLoaderException::FILE_NOT_FOUND, compact('file'));
        }
        return $is;
    }

    /**
     * @param string $name
     * @param string $includePath
     * @return AutoLoader
     */
    static public function add($name, $includePath)
    {
        self::$includePaths[$name] = $includePath;
        return self::single();
    }

    /**
     * @param string $className
     * @throws AutoLoaderException
     */
    public static function autoload($className)
    {
        $libs = array_keys(self::$includePaths);
        $path = str_replace('\\', DIRECTORY_SEPARATOR, $className);

        for ($i = 0, $c = count($libs); $i < $c; $i++) {
            if (self::loadFile(self::$includePaths[$libs[$i]] . $path, ($i != $c - 1))) {
                return;
            }
        }

        $includePaths = function () {
            return '<br/> [ Include Paths ]'
            . '<br/><li>' . implode('</li><li>', self::$includePaths) . '</li><br/>';
        };

        // @Throw AutoLoaderException
        throw new AutoLoaderException(AutoLoaderException::CLASS_NOT_FOUND, compact('className', 'includePaths'));
    }
}