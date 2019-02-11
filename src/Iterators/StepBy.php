<?php

namespace ReIterator\Iterators;

use ReIterator\IteratorIterator;

final class StepBy extends IteratorIterator
{
    protected $step;

    public function __construct(\Iterator $from, $step)
    {
        parent::__construct($from);
        $this->step = $step;
    }

    public function next()
    {
        for ($i = 0; $i < $this->step; $i++) {
            $this->from->next();
        }
    }
}
