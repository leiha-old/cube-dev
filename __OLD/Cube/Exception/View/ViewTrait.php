<?php
/**
 * Class ViewTrait
 * @author Leiha Sellier <leiha.sellier@gmail.com>
 * @link   https://github.com/leiha
 * -
 */

namespace OLD\Cube\Exception\View;

use Cube\Exception\Exception;

trait ViewTrait
{
    /**
     * @var Exception
     */
    protected $exception;

    public function __construct(Exception $exception)
    {
        $this->exception = $exception;
    }
}