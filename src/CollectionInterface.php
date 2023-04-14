<?php

declare(strict_types=1);

namespace Ser\Generic;

use Traversable;

/**
 * Collection interface
 *
 * @template TItem
 * @psalm-template TItem
 * @phpstan-template TItem
 *
 * @extends ArrayInterface<array-key, TItem>
 * @template-extends ArrayInterface<array-key, TItem>
 */
interface CollectionInterface extends ArrayInterface
{
    /**
     * Adds an element at the end of the collection.
     *
     * @param TItem $item The element to add.
     * @psalm-param TItem $item
     * @phpstan-param TItem $item
     *
     * @return void
     */
    public function add($item): void;

    /**
     * Gets the element at the specified key/index.
     *
     * @param int $index
     *
     * @return TItem|null
     * @psalm-return TItem|null
     * @phpstan-return TItem|null
     */
    public function get(int $index): mixed;

    /**
     * Sets an element in the collection at the specified key/index.
     *
     * @param int $index
     * @param TItem $item
     * @psalm-param TItem $item
     * @phpstan-param TItem $item
     *
     * @return void
     */
    public function set(int $index, mixed $item): void;

    /**
     * Removes the specified element from the collection, if it is found.
     *
     * @param TItem $item The element to remove.
     * @psalm-param TItem $item
     * @phpstan-param TItem $item
     *
     * @return void
     */
    public function remove(mixed $item): void;

    /**
     * Removes the element at the specified index from the collection.
     *
     * @param int $index The key/index of the element to remove.
     *
     * @return void
     */
    public function removeAt(int $index): void;

    /**
     * Checks whether the collection contains an element with the specified key/index.
     *
     * @param int $key The key/index to check for.
     *
     * @return bool
     */
    public function containsKey(int $key): bool;

    /**
     * Gets the index/key of a given element.
     *
     * @param TItem $item  The element to search for.
     * @psalm-param TItem $item
     * @phpstan-param TItem $item
     *
     * @return int
     */
    public function indexOf(mixed $item): int;

    /**
     * @return Traversable<int, TItem>
     * @psalm-return Traversable<int, TItem>
     * @phpstan-return Traversable<int, TItem>
     */
    public function getIterator(): Traversable;
}
