<?php

namespace ReIterator\Iterators;

use ReIterator\IteratorIterator;

final class Enumerate extends IteratorIterator
{

    public function __construct(\Iterator $from)
    {
        parent::__construct($from);
    }

    public function current()
    {
        return [$this->_iter, parent::current()];
    }
}
