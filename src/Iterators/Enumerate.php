<?php

namespace ReIterator\Iterators;

use ReIterator\IteratorIterator;

final class Enumerate extends IteratorIterator
{
    protected $index = 0;

    public function __construct(\Iterator $from)
    {
        parent::__construct($from);
    }

    public function next()
    {
        parent::next();
        $this->index = $this->index + 1;
    }

    public function current()
    {
        return [$this->index, parent::current()];
    }
}
