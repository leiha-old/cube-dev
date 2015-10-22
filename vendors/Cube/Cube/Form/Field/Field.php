<?php
/**
 * Created by PhpStorm.
 * User: lia
 * Date: 22/10/15
 * Time: 17:09
 */

namespace Cube\Form;

use Cube\Collection\Collection;
use Cube\Collection\CollectionException;
use Cube\Validator\FieldSet\FieldSet;

class Field
    extends \Cube\Validator\FieldSet\Field\Field
{
    /**
     * @var Collection
     */
    protected $attributes;


    /**
     * @return string
     */
    public function renderBody()
    {
        return '';
    }

    /**
     * @return string
     */
    public function renderAttributes()
    {
        $attrs = array();
        $this->attributes->iterate(function($value, $key)
            use (&$attrs)
        {
            if(is_array($value)){
                $value = json_encode($value);
            }
            $attrs[] = $key.'="'.$value.'"';

        });
        return ' '.implode(' ', $attrs);
    }

    /**
     * @param string $content
     * @param array  $attrs
     * @return string
     */
    protected function tag($type, $content, $attrs = array())
    {
        return "<$type$attrs>$content</$type>";
    }

    /**
 * @return string
 */
    public function render()
    {
        return $this->tag('div', $this->renderBody(), $this->renderAttributes());
    }

    /**
     * @param string   $fieldName
     * @param FieldSet $parentFieldSet
     */
    public function __construct($fieldName, FieldSet $parentFieldSet = null)
    {
        parent::__construct($fieldName, $parentFieldSet);
        $this->attributes = Collection::single();
    }

    /**
     * @param string $attrName
     * @param mixed  $defaultValue
     * @return $this
     * @throws CollectionException
     */
    public function getAttribute($attrName, $defaultValue = null)
    {
        $this->attributes->getOr($attrName, $defaultValue);
        return $this;
    }

    /**
     * @param string $attrName
     * @param mixed  $value
     * @return $this
     * @throws CollectionException
     */
    public function addAttribute($attrName, $value)
    {
        $this->attributes->set($attrName, $value);
        return $this;
    }

    /**
     * @param array $attributes
     * @return $this
     * @throws CollectionException
     */
    public function setAttributes(array $attributes)
    {
        $this->attributes->setAll($attributes);
        return $this;
    }
}