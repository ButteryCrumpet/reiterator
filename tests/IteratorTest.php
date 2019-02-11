<?php

use ReIterator\Iterator;
use PHPUnit\Framework\TestCase;

class IteratorTest extends TestCase
{
    private $mock;

    public function setUp(): void
    {
        $this->mock = $this->getMockForAbstractClass(Iterator::class);
    }

    public function testStep_by()
    {
        $this->assertInstanceOf(
            \ReIterator\IteratorInterface::class,
            $this->mock->step_by(5)
        );
    }

    public function testTake()
    {
        $this->assertInstanceOf(
            \ReIterator\IteratorInterface::class,
            $this->mock->take(5)
        );
    }

    public function testFlat_map()
    {
        $this->assertInstanceOf(
            \ReIterator\IteratorInterface::class,
            $this->mock->flat_map(function () {})
        );
    }

    public function testSkip_while()
    {
        $this->assertInstanceOf(
            \ReIterator\IteratorInterface::class,
            $this->mock->skip_while(function () {})
        );
    }

    public function testChain()
    {
        $this->assertInstanceOf(
            \ReIterator\IteratorInterface::class,
            $this->mock->chain(new ArrayIterator())
        );
    }

    public function testMap()
    {
        $this->assertInstanceOf(
            \ReIterator\IteratorInterface::class,
            $this->mock->map(function () {})
        );
    }

    public function testZip()
    {
        $this->assertInstanceOf(
            \ReIterator\IteratorInterface::class,
            $this->mock->zip(new ArrayIterator(["hi"]))
        );
    }

    public function testReverse()
    {
        //TODO: implement reverse
    }

    public function testFor_each()
    {
        $this->assertInstanceOf(
            \ReIterator\IteratorInterface::class,
            $this->mock->for_each(function () {})
        );
    }

    public function testCount()
    {

    }

    public function testSkip()
    {
        $this->assertInstanceOf(
            \ReIterator\IteratorInterface::class,
            $this->mock->skip(5)
        );
    }

    public function testNth()
    {

    }

    public function testEnumerate()
    {
        $this->assertInstanceOf(
            \ReIterator\IteratorInterface::class,
            $this->mock->enumerate()
        );
    }

    public function testFlatten()
    {
        $this->assertInstanceOf(
            \ReIterator\IteratorInterface::class,
            $this->mock->flatten()
        );
    }

    public function testLast()
    {

    }

    public function testFold()
    {

    }

    public function testFilter_map()
    {
        $this->assertInstanceOf(
            \ReIterator\IteratorInterface::class,
            $this->mock->filter_map(function () {})
        );
    }

    public function testTake_while()
    {
        $this->assertInstanceOf(
            \ReIterator\IteratorInterface::class,
            $this->mock->take_while(function () {})
        );
    }

    public function testFilter()
    {
        $this->assertInstanceOf(
            \ReIterator\IteratorInterface::class,
            $this->mock->filter(function () {})
        );
    }

    public function testPeek()
    {
        $this->assertInstanceOf(
            \ReIterator\IteratorInterface::class,
            $this->mock->peekable()
        );
    }
}
