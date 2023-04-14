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
 * @template-implements StackInterface<TItem>
 */
class Stack extends AbstractArray implements StackInterface
{
    /**
     * @param iterable<TItem> $items
     */
    public function __construct(iterable $items = []) {
        parent::__construct($items);
    }

    /**
     * Inserts an object at the top of the stack.
     *
     * @param TItem $item The object to push onto the stack
     * @psalm-param TItem $item
     * @phpstan-param TItem $item
     *
     * @return void
     */
    public function push(mixed $item): void
    {
        $this->items[] = $item;
    }

    /**
     * Returns the object at the top of the stack without removing it.
     *
     * @return TItem|null
     * @psalm-return TItem|null
     * @phpstan-return TItem|null
     */
    public function pop(): mixed
    {
        return array_pop($this->items);
    }

    /**
     * Returns the object at the top of the stack without removing it.
     *
     * @return TItem|null
     * @psalm-return TItem|null
     * @phpstan-return TItem|null
     */
    public function peek(): mixed
    {
        $idx = $this->count() - 1;

        if (!isset($this->items[$idx])){
            return null;
        }

        return $this->items[$idx];
    }

    /**
     * @return Traversable<array-key, TItem>
     * @psalm-return Traversable<array-key, TItem>
     * @phpstan-return Traversable<array-key, TItem>
     */
    public function getIterator(): Traversable
    {
        while($item = $this->pop()) {
            yield $item;
        }
    }
}
