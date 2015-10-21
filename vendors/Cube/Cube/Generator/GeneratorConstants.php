<?php
/**
 * Created by PhpStorm.
 * User: lia
 * Date: 15/10/15
 * Time: 21:11
 */

namespace Cube\Generator;

interface GeneratorConstants
{
    const TYPE_interface        = 'interface';
    const TYPE_class            = 'class';
    const TYPE_abstract         = 'abstract class';
    const TYPE_trait            = 'trait';

    const VISIBILITY_public     = 'public';
    const VISIBILITY_protected  = 'protected';
    const VISIBILITY_private    = 'public';
}