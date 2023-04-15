<?php

declare(strict_types=1);

namespace Ser\Collections;

use PHPUnit\Framework\TestCase;
use Ser\Collections\TestData\Section;

class StackTest extends TestCase
{
    /**
     * @var Stack<string>
     */
    private Stack $stack;

    protected function setUp(): void
    {
        $this->stack = new Stack();

        parent::setUp();
    }

    public function testPushItem(): void
    {
        $item = 'some item';

        $this->assertFalse($this->stack->contains($item));
        $this->stack->push($item);
        $this->assertTrue($this->stack->contains($item));
    }

    public function testPopIfItemNotExists(): void
    {
        $this->assertNull($this->stack->pop());
    }

    public function testPopItem(): void
    {
        $testData = 'some item';
        $this->stack->push($testData);

        $this->assertTrue($this->stack->contains($testData));
        $item = $this->stack->pop();

        $this->assertEquals($testData, $item);
        $this->assertFalse($this->stack->contains($testData));
    }

    public function testPeekIfItemNotExists(): void
    {
        $this->assertNull($this->stack->peek());
    }

    public function testPeekItem(): void
    {
        $item = 'some item';
        $this->stack->push($item);

        $this->assertTrue($this->stack->contains($item));
        $peeked = $this->stack->peek();

        $this->assertEquals($item, $peeked);
        $this->assertTrue($this->stack->contains($item));
    }

    /**
     * Need for phpstan/psalm test
     *
     * @return void
     */
    public function testStackWithObjects(): void
    {
        $section = new Section("Section");

        $stack = $this->createStack();
        $stack->push($section);

        foreach ($stack as $value) {
            $this->assertSame($section, $value);
        }
    }

    public function testStackInterfaceWithObjects(): void
    {
        $section = new Section("Section");

        $stack = $this->createStackInterface();
        $stack->push($section);

        foreach ($stack as $value) {
            $this->assertSame($section, $value);
        }
    }

    /**
     * @return Stack<Section>
     */
    private function createStack(): Stack
    {
        return new Stack();
    }

    /**
     * @return StackInterface<Section>
     */
    private function createStackInterface(): StackInterface
    {
        return new Stack();
    }
}
