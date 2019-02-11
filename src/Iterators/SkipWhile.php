<?php

namespace ReIterator\Iterators;

use ReIterator\IteratorIterator;

final class SkipWhile extends IteratorIterator
{
    protected $skipFn;

    public function __construct(\Iterator $from, \Closure $skip)
    {
        parent::__construct($from);
        $this->skipFn = $skip;
    }

    public function current()
    {
        while (call_user_func($this->skipFn, parent::current()) && $this->valid())
        {
            parent::next();
        }
        return parent::current();
    }
}
