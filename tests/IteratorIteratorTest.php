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

    public function testCollect()
    {
        $instance = new IteratorIterator(new ArrayIterator([0, 2, 6]));

        $this->assertEquals(
            [0, 2, 6],
            $instance->collect()
        );
    }

    public function testChaining()
    {
        $testArr = [1, 2, 3, 4, 5, 6];
        $instance = new IteratorIterator(new ArrayIterator($testArr));

        $done = $instance
            ->skip(1)
            ->filter(function ($n) { return $n & 1; })
            ->map(function ($n) { return $n * 2; })
            ->take(2)
            ->chain(new ArrayIterator([[7, 8], 9, 10]))
            ->flatten()
            ->step_by(2)
            ->enumerate()
            ->filter_map(function ($v) {
                $s = $v[0] + $v[1];
                return $s & 1 ? $s : null;
            })
            ->zip(new ArrayIterator([1, 2]))
            ->flat_map(function ($v) { return $v * $v; })
            ->collect();

        $this->assertEquals(
            [121, 1],
            $done
        );
    }
}
