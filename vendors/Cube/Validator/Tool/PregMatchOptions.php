<?php
/**
 * Created by PhpStorm.
 * User: lia
 * Date: 24/09/15
 * Time: 15:44
 */

namespace Cube\Validator\Tool;

use Cube\Validator\Constraint\ConstraintOptions;

class PregMatchOptions
    extends ConstraintOptions
{
    private $pattern;

    public function pattern()
    {
        return $this->pattern;
    }

    /**
     * @param string $pattern
     * @return $this
     */
    public function setPattern($pattern)
    {
        $this->pattern = $pattern;
        return $this;
    }

}