<?php

namespace Cube\Validator\Cleaner;

use Cube\Dna\Gene\GeneBehavior;
use Cube\Dna\Gene\GeneHelper;

class Cleaner
    implements CleanerConstants,
               GeneBehavior

{
    const Error_ = 'Cleaner [ :cleanerName: ] not present !';

    use GeneHelper;
}