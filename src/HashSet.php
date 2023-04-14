<?php

declare(strict_types=1);

namespace Ser\Collections;

use Ser\Collections\Utils\Hasher;
use Traversable;

/**
 * HashSet interface
 *
 * @template TItem
 * @psalm-template TItem
 * @phpstan-template TItem
 *
 * @template-extends AbstractArray<array-key, TItem>
 * @template-implements ArrayInterface<array-key, TItem>
 */
class HashSet extends AbstractArray implements ArrayInterface
{
    /**
     * @param iterable<TItem> $items
     */
    public function __construct(iterable $items = []) {
        parent::__construct($items);
    }

    /**
     * Add value to hashtable
     *
     * @param TItem $item
     * @psalm-param TItem $item
     * @phpstan-param TItem $item
     *
     * @return void
     */
    public function add(mixed $item): void
    {
        $this->items[Hasher::hash($item)] = $item;
    }

    /**
     * Remove object from hashtable
     *
     * @param TItem $item
     * @psalm-param TItem $item
     * @phpstan-param TItem $item
     *
     * @return void
     */
    public function remove(mixed $item): void
    {
        unset($this->items[Hasher::hash($item)]);
    }

    /**
     * Checks if collection contains item
     *
     * @param TItem $item
     * @psalm-param TItem $item
     * @phpstan-param TItem $item
     *
     * @return bool
     */
    public function contains(mixed $item): bool
    {
        return isset($this->items[Hasher::hash($item)]);
    }

    /**
     * @return Traversable<array-key, TItem>
     * @psalm-return Traversable<array-key, TItem>
     * @phpstan-return Traversable<array-key, TItem>
     */
    public function getIterator(): Traversable
    {
        yield from $this->items;
    }
}
