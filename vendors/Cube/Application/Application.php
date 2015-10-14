<?php
/**
 * Class Application
 * @author Leiha Sellier <leiha.sellier@gmail.com>
 * @link   https://github.com/leiha
 * -
 */

namespace Cube\Application;

use Cube\Cube;
use Cube\Poo\Exception\Exception;

class Application
	extends Cube
{
	/**
	 * @param \Closure $cbOnStart
	 */
	public function __construct(\Closure $cbOnStart = null)
	{
        $this->initException();
        parent::__construct($cbOnStart);
	}

	/**
	 * @return $this
	 */
	private function initException()
	{
		$handler = function(\Exception $exception){
			//$eClass = $this->configurator->getMapping(Cube::MAPPING_EXCEPTION);
			if(!($exception instanceof Exception)) {
				$e = Exception::instance($exception->getMessage());
				$e->setFile($exception->getFile(), $exception->getLine());
				$exception = $e;
			}
			print($exception->render());
			exit;
		};
		set_exception_handler($handler);
		return $this;
	}
}