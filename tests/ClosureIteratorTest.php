<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 2019-02-11
 * Time: 13:09
 */

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

    public function collect()
    {
        $instance = new ClosureIterator(function ($i) {
            return $i < 4 ? $i * 2 : null;
        });

        $this->assertEquals(
            [0, 2, 6],
            $instance->collect()
        );
    }
}
