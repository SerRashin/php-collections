<?php

declare(strict_types=1);

namespace Ser\Collections;

use Traversable;

/**
 * @template TItem
 * @psalm-template TItem
 * @phpstan-template TItem
 *
 * @template-extends  AbstractArray<array-key, TItem>
 * @template-implements QueueInterface<TItem>
 */
class Queue extends AbstractArray implements QueueInterface
{
    /**
     * @param iterable<TItem> $items
     */
    public function __construct(iterable $items = []) {
        parent::__construct($items);
    }

    /**
     * Adds an item to the end of the queue
     *
     * @param TItem $item The object to add to the queue
     * @psalm-param TItem $item
     * @phpstan-param TItem $item
     *
     * @return void
     */
    public function enqueue(mixed $item): void
    {
        $this[] = $item;
    }

    /**
     * Removes and returns the item at the beginning of the queue
     *
     * @return TItem|null
     * @psalm-return TItem|null
     * @phpstan-return TItem|null
     */
    public function dequeue(): mixed
    {
        $index = array_key_first($this->items);

        if ($index === null) {
            return null;
        }

        $head = $this->items[$index];
        unset($this->items[$index]);

        return $head;
    }

    /**
     * Returns the object at the beginning of the queue without removing it.
     *
     * @return TItem|null
     * @psalm-return TItem|null
     * @phpstan-return TItem|null
     */
    public function peek(): mixed
    {
        $index = array_key_first($this->items);

        if ($index === null) {
            return null;
        }

        return $this->items[$index];
    }

    /**
     * @return Traversable<array-key, TItem>
     * @psalm-return Traversable<array-key, TItem>
     * @phpstan-return Traversable<array-key, TItem>
     */
    public function getIterator(): Traversable
    {
        while($item = $this->dequeue()) {
            yield $item;
        }
    }
}
