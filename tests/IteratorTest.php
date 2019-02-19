<?php

use ReIterator\Iterator;
use PHPUnit\Framework\TestCase;

class IteratorTest extends TestCase
{
    private $mock;
    private $arr;

    public function setUp(): void
    {
        $this->arr = [1, 2, 3];
        \reset($this->arr);
        $this->mock = $this->getMockForAbstractClass(Iterator::class);
        $this->mock->method("current")->willReturnCallback(function () {
            return \current($this->arr);
        });
        $this->mock->method("next")->willReturnCallback(function () {
            \next($this->arr);
        });
        $this->mock->method("key")->willReturnCallback(function () {
            return \key($this->arr);
        });
        $this->mock->method("valid")->willReturnCallback(function () {
            return \key($this->arr) !== null;
        });
        $this->mock->method("rewind")->willReturnCallback(function () {
            \reset($this->arr);
        });
    }

    public function testCollect()
    {
        $this->assertEquals(
            $this->arr,
            $this->mock->collect()
        );
    }

    public function testInto()
    {
        $aa = $this->createMock(\ArrayAccess::class);
        $aa->expects($this->exactly(3))
            ->method("offsetSet")
            ->will($this->onConsecutiveCalls(1, 2, 3));

        $this->mock->into($aa);

        $this->assertEquals(
            $this->arr,
            $this->mock->into(TestInto::class)
        );

        $this->expectException(\ReIterator\Exceptions\ClassNotFoundException::class);
        $this->mock->into("Nothing");

        $this->expectException(\InvalidArgumentException::class);
        $this->mock->into(5);

    }

    public function testNth()
    {
        $this->assertEquals(2, $this->mock->nth(2));
    }

    public function testLast()
    {
        $this->assertEquals(3, $this->mock->last());
    }

    public function testCount()
    {
        $this->assertEquals(3, count($this->mock));
    }

    public function testFold()
    {
        $this->assertEquals(
            6,
            $this->mock->fold(function($acc, $v) { return $acc + $v; }, 0)
        );
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

    public function testZipKeys()
    {
        $this->assertInstanceOf(
            \ReIterator\IteratorInterface::class,
            $this->mock->zip_keys(new ArrayIterator(["hi"]))
        );
    }

    public function testFor_each()
    {
        $this->assertInstanceOf(
            \ReIterator\IteratorInterface::class,
            $this->mock->for_each(function () {})
        );
    }

    public function testSkip()
    {
        $this->assertInstanceOf(
            \ReIterator\IteratorInterface::class,
            $this->mock->skip(5)
        );
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

class TestInto implements \ReIterator\FromIter
{
    public static function FromIter(\ReIterator\IteratorInterface $iter)
    {
        return $iter->collect();
    }
}