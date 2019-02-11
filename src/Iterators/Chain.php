<?php

namespace ReIterator\Iterators;

use ReIterator\IteratorIterator;

final class Chain extends IteratorIterator
{

    public function __construct(\Iterator $from, \Iterator $chain)
    {
        $appendIter = new \AppendIterator();
        $appendIter->append($from);
        $appendIter->append($chain);
        parent::__construct($appendIter);

    }

    public function collect()
    {
        $arr = [];
        foreach ($this as $key => $val) {
            $arr[] = [$key, $val];
        }
        return $arr;
    }

}
