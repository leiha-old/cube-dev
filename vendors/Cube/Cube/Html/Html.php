<?php
/**
 * Created by PhpStorm.
 * User: lia
 * Date: 22/10/15
 * Time: 20:03
 */

namespace Cube\Html;

use Cube\Html\Tag\Tag;

class Html
    implements HtmlConstants
{
    /**
     * @param string $content
     * @param array  $attributes
     * @return string
     */
    public static function div($content = '', array $attributes = null)
    {
        return self::tag(Tag::Div, $content, $attributes);
    }

    /**
     * @param string $type          Tag::*
     * @param string $content<
     * @param array  $attributes
     * @return string
     */
    public static function tag($type = Tag::Div, $content = '', array $attributes = null)
    {
        return Tag::instance($type, $content, $attributes);
    }
}