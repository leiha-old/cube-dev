<?php

namespace Cube;

include_once(__DIR__.'/FileSystem/AutoLoader/AutoLoader.php');

use Cube\Application\Application;
use Cube\Poo\Mapper\Mappable\MappableHelper;

abstract class Cube
    implements CubeConstants
{
    use MappableHelper;

    /**
     * @var CubeConfigurator
     */
    protected $configurator;

    /**
     * @return CubeConfigurator
     */
	public static function getConfiguratorInstance()
    {
        return CubeConfigurator::instance();
	}

    /**
	 * @param \Closure $cbOnStart
	 */
	public function __construct(\Closure $cbOnStart = null)
	{
        if(!$this->configurator) {
            $this->configurator = static::getConfiguratorInstance();
        }

		// Configure Cube
		if($cbOnStart) {
			$cbOnStart($this->configurator, $this);
		}
	}

    /**
     * @return CubeConfigurator
     */
    public function getConfigurator()
    {
        return $this->configurator;
    }


}