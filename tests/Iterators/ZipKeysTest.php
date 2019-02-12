<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 2019-02-12
 * Time: 13:20
 */

use ReIterator\Iterators\ZipKeys;
use PHPUnit\Framework\TestCase;

class ZipKeysTest extends TestCase
{

    public function test__construct()
    {
        $this->assertInstanceOf(
            ZipKeys::class,
            new ZipKeys(new ArrayIterator())
        );
    }

    public function testCurrent()
    {
        $testData = ["hi" => 1, "ho" => 2, "he" => 3];
        $instance = new ZipKeys(new ArrayIterator($testData));

        $this->assertEquals(
            [["hi", 1], ["ho", 2], ["he", 3]],
            $instance->collect()
        );
    }
}
