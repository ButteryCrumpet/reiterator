<?php

use ReIterator\Iterators\Filter;
use PHPUnit\Framework\TestCase;

class FilterTest extends TestCase
{

    public function test__construct()
    {
        $this->assertInstanceOf(
            Filter::class,
            new Filter(new ArrayIterator([]), function(){})
        );
    }

    public function testCollect()
    {
        $instance = new Filter(
            new ArrayIterator([1, 2, 3, 4, 5, 6]),
            function ($val) {
                return !($val & 1);
            }
        );

        $this->assertEquals(
            [2, 4, 6],
            $instance->collect()
        );
    }
}
