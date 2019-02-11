<?php

namespace ReIterator\Iterators;

use ReIterator\Iterator;

final class FilterMap extends Iterator
{
    public function __construct(\Iterator $from, \Closure $fn)
    {
        $filter = new Filter(new Map($from, $fn), function ($val) {
             return !is_null($val);
        });
        parent::__construct($filter);
    }
}
