<?php

declare(strict_types=1);

namespace Ser\Collections;

use PHPUnit\Framework\TestCase;
use Ser\Collections\TestData\Entry;
use Ser\Collections\Utils\Iterating;

class CollectionTest extends TestCase
{
    public function testEmptyCollection(): void
    {
        $collection = new Collection();

        $this->assertTrue($collection->isEmpty());
        $this->assertEquals(0, $collection->count());
        $this->assertEquals([], Iterating::toArray($collection));
    }

    public function testCollection(): void
    {
        $expected = ['one',1,2,3,'test'=>'test', 56=>'test'];

        $collection = new Collection($expected);

        $this->assertFalse($collection->isEmpty());
        $this->assertEquals(count($expected), $collection->count());

        $expectedValues = array_values($expected);

        foreach (Iterating::toArray($collection) as $key=>$value) {
            self::assertEquals($expectedValues[$key], $value);
        }
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

        foreach ($collection as $key => $value) {
            $this->assertSame($entries[$key], $value);
        }
    }

    public function testCollectionInterfaceWithObjects(): void
    {
        $entries = [
            new Entry("first entry"),
            new Entry("second entry"),
            new Entry("third"),
        ];

        $collection = $this->createInterfaceCollection($entries);

        foreach ($collection as $key => $value) {
            $this->assertSame($entries[$key], $value);
        }
    }

    /**
     * Create collection
     *
     * @param Entry[] $array
     *
     * @return Collection<Entry>
     */
    private function createCollection(array $array): Collection
    {
        return new Collection($array);
    }

    /**
     * Create collection
     *
     * @param Entry[] $array
     *
     * @return CollectionInterface<Entry>
     */
    private function createInterfaceCollection(array $array): CollectionInterface
    {
        return new Collection($array);
    }
}
