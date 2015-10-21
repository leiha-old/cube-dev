<?php

namespace Cube;

include_once(__DIR__.'/FileSystem/AutoLoader/AutoLoader.php');

use Cube\Application\Application;
use Cube\Connector\ConnectorConstants;
use Cube\Poo\Mapper\Mappable\MappableHelper;

abstract class Cube
    implements CubeConstants, ConnectorConstants
{
    use MappableHelper;

    /**
     * @var CubeFacade
     */
    protected $configurator;

    /**
     * @return CubeFacade
     */
	public static function getConfiguratorInstance()
    {
        return CubeFacade::instance();
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
     * @return CubeFacade
     */
    public function getConfigurator()
    {
        return $this->configurator;
    }


}