<?php
/**
 * Class CollectionGene
 * @author Leiha Sellier <leiha.sellier@gmail.com>
 * @link   https://github.com/leiha
 * -
 */

namespace Cube\Collection;

use Cube\Dna\Gene\GeneBehavior;
use Cube\Poo\Single\SingleHelper;

class CollectionGene
	implements GeneBehavior
{
	use CollectionGeneHelper;
    use SingleHelper;
}