<?php

namespace ReIterator\Iterators;


use ReIterator\IteratorIterator;
use ReIterator\RecursiveIterator;

final class Flatten extends IteratorIterator
{
    public function __construct(\Iterator $from)
    {
        if (!($from instanceof \RecursiveIterator)) {
            $from = new RecursiveIterator($from);
        }

        parent::__construct(new \RecursiveIteratorIterator($from));
    }
}
