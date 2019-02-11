<?php

namespace ReIterator\Iterators;


use ReIterator\Iterator;
use ReIterator\RecursiveIteratorWrapper;

final class Flatten extends Iterator
{
    protected $index = 0;

    public function __construct(\Iterator $from)
    {
        if (!($from instanceof \RecursiveIterator)) {
            $from = new RecursiveIteratorWrapper($from);
        }

        parent::__construct(new \RecursiveIteratorIterator($from));
    }

    public function next()
    {
        parent::next();
        $this->index = $this->index + 1;
    }

    public function key()
    {
        return $this->index;
    }

}
