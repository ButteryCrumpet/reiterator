<?php

namespace ReIterator\Iterators;

use ReIterator\IteratorIterator;

final class ForEachIter extends IteratorIterator
{
    protected $feFn;

    public function __construct(\Iterator $from, \Closure $map)
    {
        parent::__construct($from);
        $this->feFn = $map;
    }

    public function current()
    {
        $val = parent::current();
        call_user_func($this->feFn, $val);
        return $val;
    }
}
