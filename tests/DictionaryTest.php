<?php

declare(strict_types=1);

namespace Ser\Generic;

use Exception;
use OutOfRangeException;
use PHPUnit\Framework\TestCase;
use RuntimeException;
use Ser\Generic\TestData\Entry;
use Ser\Generic\TestData\Section;
use Ser\Generic\Utils\Iterating;

class DictionaryTest extends TestCase
{
    /**
     * @var array<string, string>
     */
    private array $testData = [
        "one" => "first element",
        "two" => "second element",
    ];

    /**
     * @var Dictionary<string, string>
     */
    private Dictionary $dictionary;

    protected function setUp(): void
    {
        $this->dictionary = new Dictionary();

        parent::setUp();
    }

    public function testAddItem(): void
    {
        $this->assertEquals(0, $this->dictionary->count());
        $this->dictionary->add('one', 'asdsd');
        $this->assertEquals(1, $this->dictionary->count());
    }

    public function testGetItem(): void
    {
        $expectedData = 'test data';

        $this->assertNull($this->dictionary->get('key'));
        $this->dictionary->add('key', $expectedData);
        $this->assertEquals($expectedData, $this->dictionary->get('key'));
    }

    public function testRemoveNotExistsKey(): void
    {
        $this->expectException(OutOfRangeException::class);
        $this->dictionary->remove('key');
    }

    public function testRemoveItem(): void
    {
        $expectedData = 'test data';

        $this->dictionary->add('key', $expectedData);
        $this->assertEquals($expectedData, $this->dictionary->get('key'));
        $this->dictionary->remove('key');
        $this->assertNull($this->dictionary->get('key'));
    }

    public function testDictionaryContainsKey(): void
    {
        $key = 'test data';

        $this->assertFalse($this->dictionary->containsKey($key));
        $this->dictionary->add($key, '');
        $this->assertTrue($this->dictionary->containsKey($key));
    }

    public function testDictionaryContainsValue(): void
    {
        $value = 'test data';

        $this->assertFalse($this->dictionary->containsValue($value));
        $this->dictionary->add('dds', $value);
        $this->assertTrue($this->dictionary->containsValue($value));
    }

    public function testGetKeys(): void
    {
        $this->assertEquals([], Iterating::toArray($this->dictionary->getKeys()));

        $keys = [];
        foreach ($this->testData as $key=>$value)
        {
            $keys[] = $key;
            $this->dictionary->add($key, $value);
        }

        $this->assertEquals($keys, Iterating::toArray($this->dictionary->getKeys()));
    }

    public function testGetValues(): void
    {
        $this->assertEquals([], Iterating::toArray($this->dictionary->getValues()));

        $values = [];
        foreach ($this->testData as $key=>$value)
        {
            $values[] = $value;
            $this->dictionary->add($key, $value);
        }

        $this->assertEquals($values, Iterating::toArray($this->dictionary->getValues()));
    }

    /**
     * @throws Exception
     */
    public function testGetIterator(): void
    {
        $this->assertEquals(
            [],
            Iterating::toArray($this->dictionary->getIterator())
        );

        $this->dictionary->add('one', 'asd');

        $this->assertEquals(
            [0=>'asd'],
            Iterating::toArray($this->dictionary->getIterator())
        );
    }

    public function testOffsetExists(): void
    {
        $expected = "key";

        $this->assertFalse($this->dictionary->offsetExists($expected));

        $this->dictionary->offsetSet($expected, 'val');

        $this->assertTrue($this->dictionary->offsetExists($expected));
    }

    public function testOffsetGet(): void
    {
        $key = "key";
        $val = "val";

        $this->assertNull($this->dictionary->offsetGet($key));

        $this->dictionary->offsetSet($key, $val);

        $this->assertEquals($val, $this->dictionary->offsetGet($key));
    }

    public function testOffsetSetWithoutKey(): void
    {
        $this->expectException(RuntimeException::class);
        $this->dictionary->offsetSet(null, "dsa");
    }

    public function testOffsetSet(): void
    {
        $key = "key";
        $val = "val";

        $this->assertNull($this->dictionary->offsetGet($key));

        $this->dictionary->offsetSet($key, $val);

        $this->assertEquals($val, $this->dictionary->offsetGet($key));
    }

    public function testOffsetUnset(): void
    {
        $this->dictionary->add('one', 'test');
        $this->assertEquals('test', $this->dictionary->offsetGet('one'));

        $this->dictionary->offsetUnset('one');

        $this->assertNull($this->dictionary->offsetGet('one'));
    }

    public function testCount(): void
    {
        $this->dictionary->clear();

        $this->assertEquals(0, $this->dictionary->count());

        $this->dictionary->offsetSet('asd', 'dsad');

        $this->assertEquals(1, $this->dictionary->count());
    }

    public function testClear(): void
    {
        $this->dictionary->add('one', 'test');
        $this->dictionary->add('two', 'test2');

        $this->assertEquals(count($this->testData), $this->dictionary->count());

        $this->dictionary->clear();

        $this->assertEquals(0, $this->dictionary->count());

    }

    public function testContains(): void
    {
        $expected = "some item";

        $this->assertFalse($this->dictionary->containsValue($expected));

        $this->dictionary->offsetSet('some', $expected);

        $this->assertTrue($this->dictionary->contains($expected));
    }

    public function testIsEmpty(): void
    {
        $this->dictionary->add('key', 'value');
        $this->assertFalse($this->dictionary->isEmpty());

        $this->dictionary->clear();

        $this->assertTrue($this->dictionary->isEmpty());
    }

    /**
     * Need for phpstan/psalm test
     *
     * @return void
     */
    public function testDictionaryWithObjects(): void
    {
        $section = new Section("Section");
        $entry = new Entry("Entry");

        $dictionary = $this->createDictionary();
        $dictionary->add($section, $entry);

        foreach ($dictionary as $key => $value) {
            $this->assertSame($section, $key);
            $this->assertSame($entry, $value);
        }
    }

    /**
     * @return Dictionary<Section, Entry>
     */
    private function createDictionary(): Dictionary
    {
        return new Dictionary();
    }
}
