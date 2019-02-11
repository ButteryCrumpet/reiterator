<?php

use ReIterator\ClosureIterator;
use PHPUnit\Framework\TestCase;

class ClosureIteratorTest extends TestCase
{

    public function test__construct()
    {
        $this->assertInstanceOf(
            ClosureIterator::class,
            new ClosureIterator(function () {})
        );
    }

    public function testCollect()
    {
        $instance = new ClosureIterator(function ($i) {
            return $i < 4 ? $i * 2 : null;
        });

        $this->assertEquals(
            [0, 2, 4, 6],
            $instance->collect()
        );
    }
}
