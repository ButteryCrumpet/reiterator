<?php

namespace ReIterator\Iterators;

use ReIterator\IteratorIterator;

final class Map extends IteratorIterator
{
    protected $mapFn;

    public function __construct(\Iterator $from, \Closure $map)
    {
        parent::__construct($from);
        $this->mapFn = $map;
    }

    public function current()
    {
        return call_user_func($this->mapFn, parent::current());
    }
}
