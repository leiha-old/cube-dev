<?php

namespace Cube\Template;

use Cube\Collection\CollectionHelper;
use Cube\Poo\Mapper\Mappable\Mappable;

class Template
    extends Mappable
{
    use CollectionHelper;

    /**
     * @param string $id
     * @param string $block
     * @return $this
     */
    public function addSection($id, $block)
    {
        $_block = &$this->get($id, true);
        if(!$_block) {
            $this->set($id, array($block));
        } else {
            $_block[]= $block;
        }
        return $this;
    }

}