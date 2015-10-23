<?php
/**
 * Created by PhpStorm.
 * User: lia
 * Date: 22/10/15
 * Time: 21:31
 */

namespace Cube\Html\Tag;

use Cube\Collection\Collection;
use Cube\Collection\CollectionError;
use Cube\Poo\Mapper\Mappable\MappableHelper;

class Tag
    implements TagConstants
{
    use MappableHelper;

    /**
     * @var Collection
     */
    protected $attributes;

    /**
     */
    public function __construct()
    {
        $this->attributes = Collection::single();
    }

    /**
     * @param string $attrName
     * @param mixed  $defaultValue
     * @return $this
     * @throws CollectionError
     */
    public function get($attrName, $defaultValue = null)
    {
        return $this->attributes->getOr($attrName, $defaultValue);
    }

    /**
     * @param string $attrName
     * @param mixed  $value
     * @return $this
     * @throws CollectionError
     */
    public function add($attrName, $value)
    {
        $this->attributes->set($attrName, $value);
        return $this;
    }

    /**
     * @param array $attributes
     * @return $this
     * @throws CollectionError
     */
    public function set(array $attributes)
    {
        $this->attributes->setAll($attributes);
        return $this;
    }

    /**
     * @param string $type          Tag::*
     * @param string $content<
     * @param array  $attributes
     * @return string
     */
    public function render($type = Tag::Div, $content = '', array $attributes = null)
    {
        return
            '<'.$type.$this->buildAttributes($attributes).'>'
                .$content
            .'</'.$type.'>'
            ;
    }

    /**
     * @param array $attributes
     * @return string
     */
    protected function buildAttributes(array $attributes = null)
    {
        $html = array();
        $this->attributes->iterateArray(
            $attributes ?: $this->attributes->getAll(),
            function($value, $key)
                use (&$html)
            {
                if(is_array($value)) {
                    // @Todo Check for double quote conflict with html
                    $value = json_encode($value);
                }
                $html[] = $key.'="'.$value.'"';
            }
        );
        return ' '.implode(' ', $html);
    }
}