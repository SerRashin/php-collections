<?php

declare(strict_types=1);

namespace Ser\Generic;

use Exception;
use PHPUnit\Framework\TestCase;
use Ser\Generic\TestData\Section;
use Ser\Generic\Utils\Iterating;

class HashSetTest extends TestCase
{
    /**
     * @var HashSet<string>
     */
    private HashSet $set;

    protected function setUp(): void
    {
        $this->set = new HashSet();

        parent::setUp();
    }

    public function testAddItem(): void
    {
        $item = 'some item';

        $this->assertFalse($this->set->contains($item));
        $this->set->add($item);
        $this->assertTrue($this->set->contains($item));
    }

    public function testRemoveItem(): void
    {
        $item = 'some item';
        $this->set->add($item);

        $this->assertTrue($this->set->contains($item));
        $this->set->remove($item);
        $this->assertFalse($this->set->contains($item));
    }

    public function testHashSetContainsItem(): void
    {
        $item = 'some item';
        $this->set->add($item);

        $this->assertTrue($this->set->contains($item));
    }

    /**
     * @throws Exception
     */
    public function testGetIterator(): void
    {
        $this->assertEquals([], Iterating::toArray($this->set->getIterator()));
    }

    /**
     * Need for phpstan/psalm test
     *
     * @return void
     */
    public function testSetWithObjects(): void
    {
        $section = new Section("Section");

        $set = $this->createSet();
        $set->add($section);

        foreach ($set as $value) {
            $this->assertSame($section, $value);
        }
    }

    /**
     * @return HashSet<Section>
     */
    private function createSet(): HashSet
    {
        return new HashSet();
    }
}
