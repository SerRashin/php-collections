<?php

declare(strict_types=1);

namespace Ser\Collections;

use Exception;
use OutOfRangeException;
use PHPUnit\Framework\TestCase;
use Ser\Collections\TestData\Entry;
use Ser\Collections\Utils\Iterating;

class ArrayListTest extends TestCase
{
    /**
     * @var ArrayList<string>
     */
    private ArrayList $list;

    protected function setUp(): void
    {
        $this->list = new ArrayList();
        parent::setUp();
    }

    public function testEmptyCollection(): void
    {
        $this->assertTrue($this->list->isEmpty());
        $this->assertEquals(0, $this->list->count());
        $this->assertEquals([], Iterating::toArray($this->list));
    }

    public function testCollectionInitializationFromConstructor(): void
    {
        $expected = ['1','2','3'];

        $this->list = new ArrayList($expected);

        $this->assertFalse($this->list->isEmpty());
        $this->assertEquals(count($expected), $this->list->count());
        $this->assertEquals($expected, Iterating::toArray($this->list));
    }

    public function testAddItem(): void
    {
        $item = 'some data';

        $this->assertTrue($this->list->isEmpty());
        $this->assertEquals(0, $this->list->count());
        $this->assertEquals([], Iterating::toArray($this->list));

        $this->list->add($item);

        $this->assertFalse($this->list->isEmpty());
        $this->assertEquals(1, $this->list->count());
        $this->assertEquals([$item], Iterating::toArray($this->list));
    }

    public function testGetItem(): void
    {
        $expected = 'some';

        $this->assertNull($this->list->get(0));
        $this->list->add($expected);
        $this->assertEquals($expected, $this->list->get(0));
    }

    public function testSetItem(): void
    {
        $expected = 'some value';
        $this->assertNull($this->list->get(0));
        $this->list->set(0, $expected);
        $this->assertEquals($expected, $this->list->get(0));
    }

    public function testRemoveNotExistsElement(): void
    {
        $this->expectException(OutOfRangeException::class);
        $this->list = new ArrayList();
        $this->list->remove('1');
    }

    public function testRemoveItem(): void
    {
        $this->list->add($one = 'One');
        $this->list->add($two = 'Two');
        $this->list->add($three = 'Three');

        $this->assertEquals($one, $this->list->get(0));
        $this->assertEquals($two, $this->list->get(1));
        $this->assertEquals($three, $this->list->get(2));

        $this->list->remove($two);

        $this->assertEquals($one, $this->list->get(0));
        $this->assertNull($this->list->get(1));
        $this->assertEquals($three, $this->list->get(2));
    }

    public function testRemoveAtNotExistsElement(): void
    {
        $this->expectException(OutOfRangeException::class);
        $this->list->removeAt(1);
    }

    public function testRemoveItemAt(): void
    {
        $this->list->add($one = 'One');
        $this->list->add($two = 'Two');
        $this->list->add($three = 'Three');

        $this->assertEquals($one, $this->list->get(0));
        $this->assertEquals($two, $this->list->get(1));
        $this->assertEquals($three, $this->list->get(2));

        $this->list->removeAt(1);

        $this->assertEquals($one, $this->list->get(0));
        $this->assertNull($this->list->get(1));
        $this->assertEquals($three, $this->list->get(2));
    }

    public function testClear(): void
    {
        $this->list->add('One');

        $this->assertEquals(1, $this->list->count());
        $this->list->clear();
        $this->assertEquals(0, $this->list->count());

    }

    public function testContains(): void
    {
        $this->list->add($one = 'One');

        $this->assertFalse($this->list->contains("three"));
        $this->assertTrue($this->list->contains($one));
    }

    public function testCollectionContainsItemByKey(): void
    {
        $this->assertFalse($this->list->containsKey(0));
        $this->list->add('one');
        $this->assertTrue($this->list->containsKey(0));
    }

    public function testIndexOf(): void
    {
        $expected = 'One';

        $this->assertEquals(-1, $this->list->indexOf($expected));
        $this->list->add("test");
        $this->list->add($expected);
        $this->assertEquals(1, $this->list->indexOf($expected));
    }

    /**
     * @throws Exception
     */
    public function testGetIterator(): void
    {
        $this->assertEquals([], Iterating::toArray($this->list->getIterator()));
        $this->list->add($expected = 'One');
        $this->assertEquals([$expected], Iterating::toArray($this->list->getIterator()));
    }

    /**
     * Need for phpstan/psalm test
     *
     * @return void
     */
    public function testArrayListWithObjects(): void
    {
        $entries = [
            new Entry("first entry"),
            new Entry("second entry"),
        ];

        $list = $this->createArrayList($entries);

        foreach ($list as $key => $value) {
            $this->assertSame($entries[$key], $value);
        }
    }

    public function testListInterfaceWithObjects(): void
    {
        $entries = [
            new Entry("first entry"),
            new Entry("second entry"),
        ];

        $list = $this->createListInterface($entries);

        foreach ($list as $key => $value) {
            $this->assertSame($entries[$key], $value);
        }
    }

    /**
     * @param Entry[] $array
     *
     * @return ArrayList<Entry>
     */
    private function createArrayList(array $array): ArrayList
    {
        return new ArrayList($array);
    }

    /**
     * @param Entry[] $array
     *
     * @return ListInterface<Entry>
     */
    private function createListInterface(array $array): ListInterface
    {
        return new ArrayList($array);
    }
}
