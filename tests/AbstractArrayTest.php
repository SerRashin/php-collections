<?php

declare(strict_types=1);

namespace Ser\Generic;

use Exception;
use PHPUnit\Framework\TestCase;
use Ser\Generic\TestData\AbstractArrayFixture;
use Ser\Generic\Utils\Iterating;

class AbstractArrayTest extends TestCase
{
    /**
     * @var string[]
     */
    private array $testData = [
        "one",
        "two",
    ];

    private AbstractArrayFixture $collection;

    protected function setUp(): void
    {
        $this->collection = new AbstractArrayFixture($this->testData);

        parent::setUp();
    }

    /**
     * @throws Exception
     */
    public function testGetIterator(): void
    {
        $this->assertEquals($this->testData, Iterating::toArray($this->collection->getIterator()));
    }

    public function testOffsetExists(): void
    {
        $expected = "key";

        $this->assertFalse($this->collection->offsetExists($expected));

        $this->collection->offsetSet($expected, 'val');

        $this->assertTrue($this->collection->offsetExists($expected));
    }

    public function testOffsetGet(): void
    {
        $key = "key";
        $val = "val";

        $this->assertNull($this->collection->offsetGet($key));

        $this->collection->offsetSet($key, $val);

        $this->assertEquals($val, $this->collection->offsetGet($key));
    }

    public function testOffsetSet(): void
    {
        $key = "key";
        $val = "val";

        $this->assertNull($this->collection->offsetGet($key));

        $this->collection->offsetSet($key, $val);

        $this->assertEquals($val, $this->collection->offsetGet($key));
    }

    public function testOffsetUnset(): void
    {
        $this->assertEquals($this->testData[0], $this->collection->offsetGet(0));

        $this->collection->offsetUnset(0);

        $this->assertNull($this->collection->offsetGet(0));
    }

    public function testCount(): void
    {
        $this->collection->clear();

        $this->assertEquals(0, $this->collection->count());

        $this->collection->offsetSet(0, 0);

        $this->assertEquals(1, $this->collection->count());
    }

    public function testClear(): void
    {
        $this->assertEquals(count($this->testData), $this->collection->count());

        $this->collection->clear();

        $this->assertEquals(0, $this->collection->count());

    }

    public function testContains(): void
    {
        $expected = "some item";

        $this->assertFalse($this->collection->contains($expected));

        $this->collection->offsetSet(null, $expected);

        $this->assertTrue($this->collection->contains($expected));
    }

    public function testIsEmpty(): void
    {
        $this->assertFalse($this->collection->isEmpty());

        $this->collection->clear();

        $this->assertTrue($this->collection->isEmpty());
    }
}
