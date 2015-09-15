<?php
/**
 * Class ViewTrait
 * @author Leiha Sellier <leiha.sellier@gmail.com>
 * @link   https://github.com/leiha
 * -
 */

namespace Cube\Exception\View;

use Cube\Cube\CubeException;

trait ViewTrait
{
    /**
     * @var CubeException
     */
    protected $exception;

    public function __construct(CubeException $exception)
    {
        $this->exception = $exception;
    }
}