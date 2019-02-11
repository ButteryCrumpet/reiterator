<?php

namespace ReIterator\Iterators;

use ReIterator\IteratorIterator;
use ReIterator\RecursiveIterator;

final class FlatMap extends IteratorIterator
{
    protected $mapFn;

    public function __construct(\Iterator $from, \Closure $map)
    {
        if (!($from instanceof \RecursiveIterator)) {
            $from = new RecursiveIterator($from);
        }

        parent::__construct(new \RecursiveIteratorIterator($from));
        $this->mapFn = $map;
    }

    public function current()
    {
        return call_user_func($this->mapFn, parent::current());
    }
}
