<?php

namespace Cube;

include_once(__DIR__.'/FileSystem/AutoLoader/AutoLoader.php');

use Cube\Connector\ConnectorConstants;
use Cube\Poo\Mapper\Mappable\MappableHelper;

abstract class Cube
    implements CubeConstants, ConnectorConstants
{
    use MappableHelper;




}