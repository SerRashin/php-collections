<?php

declare(strict_types=1);

namespace Ser\Generic;

use Exception;
use OutOfRangeException;
use PHPUnit\Framework\TestCase;
use Ser\Generic\TestData\Entry;
use Ser\Generic\Utils\Iterating;

class CollectionTest extends TestCase
{
    public function testEmptyCollection(): void
    {
        $collection = new Collection();

        $this->assertTrue($collection->isEmpty());
        $this->assertEquals(0, $collection->count());
        $this->assertEquals([], Iterating::toArray($collection));
    }

    public function testCollectionInitializationFromConstructor(): void
    {
        $expected = [1,2,3];

        $collection = new Collection($expected);

        $this->assertFalse($collection->isEmpty());
        $this->assertEquals(count($expected), $collection->count());
        $this->assertEquals($expected, Iterating::toArray($collection));
    }

    public function testAddItem(): void
    {
        $item = 'some data';

        $collection = new Collection();

        $this->assertTrue($collection->isEmpty());
        $this->assertEquals(0, $collection->count());
        $this->assertEquals([], Iterating::toArray($collection));

        $collection->add($item);

        $this->assertFalse($collection->isEmpty());
        $this->assertEquals(1, $collection->count());
        $this->assertEquals([$item], Iterating::toArray($collection));
    }

    public function testGetItem(): void
    {
        $expected = 'some';

        $collection = new Collection();

        $this->assertNull($collection->get(0));

        $collection->add($expected);

        $this->assertEquals($expected, $collection->get(0));
    }

    public function testSetItem(): void
    {
        $expected = 'some value';
        $collection = new Collection();

        $this->assertNull($collection->get(0));

        $collection->set(0, $expected);

        $this->assertEquals($expected, $collection->get(0));
    }

    public function testRemoveNotExistsElement(): void
    {
        $this->expectException(OutOfRangeException::class);

        $collection = new Collection();

        $collection->remove(1);
    }

    public function testRemoveItem(): void
    {
        $one = 'One';
        $two = 'Two';
        $three = 'Three';

        $collection = new Collection([$one, $two, $three]);

        $this->assertEquals($one, $collection->get(0));
        $this->assertEquals($two, $collection->get(1));
        $this->assertEquals($three, $collection->get(2));

        $collection->remove($two);

        $this->assertEquals($one, $collection->get(0));
        $this->assertNull($collection->get(1));
        $this->assertEquals($three, $collection->get(2));
    }

    public function testRemoveAtNotExistsElement(): void
    {
        $this->expectException(OutOfRangeException::class);

        $collection = new Collection();

        $collection->removeAt(1);
    }

    public function testRemoveItemAt(): void
    {
        $one = 'One';
        $two = 'Two';
        $three = 'Three';

        $collection = new Collection([$one, $two, $three]);

        $this->assertEquals($one, $collection->get(0));
        $this->assertEquals($two, $collection->get(1));
        $this->assertEquals($three, $collection->get(2));

        $collection->removeAt(1);

        $this->assertEquals($one, $collection->get(0));
        $this->assertNull($collection->get(1));
        $this->assertEquals($three, $collection->get(2));
    }

    public function testCollectionContainsItemByKey(): void
    {
        $expected = "some item";
        $collection = new Collection();

        $this->assertFalse($collection->containsKey(0));

        $collection->add($expected);

        $this->assertTrue($collection->containsKey(0));
    }

    public function testIndexOf(): void
    {
        $expected = "some item";
        $collection = new Collection();

        $this->assertEquals(-1, $collection->indexOf($expected));

        $collection->add("test");
        $collection->add($expected);

        $this->assertEquals(1, $collection->indexOf($expected));
    }

    /**
     * @throws Exception
     */
    public function testGetIterator(): void
    {
        $expected = "some item";
        $collection = new Collection();

        $this->assertEquals([], Iterating::toArray($collection->getIterator()));

        $collection->add($expected);

        $this->assertEquals([$expected], Iterating::toArray($collection->getIterator()));
    }

    /**
     * Need for phpstan/psalm test
     *
     * @return void
     */
    public function testCollectionWithObjects(): void
    {
        $entries = [
            new Entry("first entry"),
            new Entry("second entry"),
        ];

        $collection = $this->createCollection($entries);

        foreach ($collection as $k=>$value) {
            $this->assertSame($entries[$k], $value);
        }
    }

    /**
     * @param Entry[] $array
     *
     * @return CollectionInterface<Entry>
     */
    private function createCollection(array $array): CollectionInterface
    {
        return new Collection($array);
    }
}
