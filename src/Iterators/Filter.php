<?php

namespace ReIterator\Iterators;

use ReIterator\IteratorIterator;

final class Filter extends IteratorIterator
{
    protected $index = 0;

    public function __construct(\Iterator $from, \Closure $filter)
    {
        parent::__construct(new \CallbackFilterIterator($from, $filter));
    }
}
