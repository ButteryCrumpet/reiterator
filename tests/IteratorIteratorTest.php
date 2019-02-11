<?php

use ReIterator\IteratorIterator;
use PHPUnit\Framework\TestCase;

class IteratorIteratorTest extends TestCase
{

    public function test__construct()
    {
        $this->assertInstanceOf(
            IteratorIterator::class,
            new IteratorIterator(new ArrayIterator())
        );
    }

    public function collect()
    {
        $instance = new IteratorIterator(new ArrayIterator([0, 2, 6]));

        $this->assertEquals(
            [0, 2, 6],
            $instance->collect()
        );
    }
}
