<?php

use ReIterator\ArrayIterator;
use PHPUnit\Framework\TestCase;

class ArrayIteratorTest extends TestCase
{

    public function test__construct()
    {
        $this->assertInstanceOf(
            ArrayIterator::class,
            new ArrayIterator([])
        );
    }

    public function testCollect()
    {
        $testArr = [1, 2, 3];
        $instance = new ArrayIterator($testArr);

        $this->assertEquals(
            $testArr,
            $instance->collect()
        );
    }
}
