<?php

namespace ReIterator\Iterators;


use ReIterator\IteratorIterator;

class ZipKeys extends IteratorIterator
{
    public function __construct(\Iterator $from)
    {
        parent::__construct($from);
    }


    public function current()
    {
        return [$this->key(), parent::current()];
    }
}