<?php

namespace ReIterator\Iterators;

use ReIterator\IteratorIterator;

final class Skip extends IteratorIterator
{

    public function __construct(\Iterator $from, $n)
    {
        parent::__construct(new \LimitIterator($from, $n));
    }
}
