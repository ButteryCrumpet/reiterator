<?php

namespace ReIterator\Iterators;

use ReIterator\IteratorIterator;

final class Zip extends IteratorIterator
{
    private $first;

    public function __construct(\Iterator $from, \Iterator $zip)
    {
        $multi = new \MultipleIterator(\MultipleIterator::MIT_NEED_ANY);
        $multi->attachIterator($from);
        $multi->attachIterator($zip);
        parent::__construct($multi);
        $this->first = $from;
    }

    public function valid()
    {
        return $this->first->valid();
    }

    public function collect()
    {
        $arr = [];
        foreach ($this as $val) {
            $arr[] = $val;
        }
        return $arr;
    }
}
