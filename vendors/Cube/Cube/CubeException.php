<?php
/**
 * Class CubeException
 * @author Leiha Sellier <leiha.sellier@gmail.com>
 * @link   https://github.com/leiha
 * -
 */

namespace Cube\Cube;

use Cube\Exception\Exception;
use Cube\Exception\View\ViewHtml;

class CubeException
    extends Exception
{
    /**
     * @return string
     */
    public function render()
    {
        $render = new ViewHtml($this);
        return $render->render();
    }
}