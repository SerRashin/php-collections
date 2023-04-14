<?php

declare(strict_types=1);

namespace Ser\Collections;

use PHPUnit\Framework\TestCase;
use Ser\Collections\TestData\Section;

class QueueTest extends TestCase
{
    /**
     * @var Queue<string>
     */
    private Queue $queue;

    protected function setUp(): void
    {
        $this->queue = new Queue();

        parent::setUp();
    }

    public function testEnqueueItem(): void
    {
        $item = 'some item';

        $this->assertFalse($this->queue->contains($item));
        $this->queue->enqueue($item);
        $this->assertTrue($this->queue->contains($item));
    }

    public function testDequeueIfItemNotExists(): void
    {
        $dequeued = $this->queue->dequeue();

        $this->assertNull($dequeued);
    }

    public function testDequeueItem(): void
    {
        $item = 'some item';
        $this->queue->enqueue($item);

        $this->assertTrue($this->queue->contains($item));
        $dequeued = $this->queue->dequeue();

        $this->assertEquals($item, $dequeued);
        $this->assertFalse($this->queue->contains($item));
    }

    public function testPeekIfItemNotExists(): void
    {
        $dequeued = $this->queue->peek();

        $this->assertNull($dequeued);
    }

    public function testPeekItem(): void
    {
        $item = 'some item';
        $this->queue->enqueue($item);

        $this->assertTrue($this->queue->contains($item));
        $peeked = $this->queue->peek();

        $this->assertEquals($item, $peeked);
        $this->assertTrue($this->queue->contains($item));
    }

    /**
     * Need for phpstan/psalm test
     *
     * @return void
     */
    public function testSetWithObjects(): void
    {
        $section = new Section("Section");

        $queue = $this->createStack();
        $queue->enqueue($section);

        foreach ($queue as $value) {
            $this->assertSame($section, $value);
        }
    }

    /**
     * @return Queue<Section>
     */
    private function createStack(): Queue
    {
        return new Queue();
    }
}
