<?php

declare(strict_types=1);

namespace Ser\Collections;

use OutOfRangeException;
use Ser\Collections\Exception\Errors;
use Traversable;

use function array_search;

/**
 * @template TItem
 * @psalm-template TItem
 * @phpstan-template TItem
 *
 * @template-extends  AbstractArray<array-key, TItem>
 * @template-implements CollectionInterface<TItem>
 */
class Collection extends AbstractArray implements CollectionInterface
{
    /**
     * @param iterable<TItem> $items
     */
    public function __construct(iterable $items = []) {
        parent::__construct($items);
    }

    /**
     * Adds an element at the end of the collection.
     *
     * @param TItem $item The element to add.
     * @psalm-param TItem $item
     * @phpstan-param TItem $item
     *
     * @return void
     */
    public function add($item): void
    {
        $this->items[] = $item;
    }

    /**
     * Gets the element at the specified key/index.
     *
     * @param int $index
     *
     * @return TItem|null
     * @psalm-return TItem|null
     * @phpstan-return TItem|null
     */
    public function get(int $index): mixed
    {
        return $this->items[$index] ?? null;
    }

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
    public function set(int $index, mixed $item): void
    {
        $this->items[$index] = $item;
    }

    /**
     * Removes the specified element from the collection, if it is found.
     *
     * @param TItem $item The element to remove.
     * @psalm-param TItem $item
     * @phpstan-param TItem $item
     *
     * @return void
     */
    public function remove(mixed $item): void
    {
        $index = array_search($item, $this->items, true);

        if ($index === false) {
            throw new OutOfRangeException(Errors::OUT_OF_RANGE);
        }

        unset($this->items[$index]);
    }

    /**
     * Removes the element at the specified index from the collection.
     *
     * @param int $index The key/index of the element to remove.
     *
     * @return void
     */
    public function removeAt(int $index): void
    {
        if (!isset($this->items[$index])) {
            throw new OutOfRangeException(Errors::OUT_OF_RANGE);
        }

        unset($this->items[$index]);
    }

    /**
     * Checks whether the collection contains an element with the specified key/index.
     *
     * @param int $key The key/index to check for.
     *
     * @return bool
     */
    public function containsKey(int $key): bool
    {
        return isset($this->items[$key]);
    }

    /**
     * Gets the index/key of a given element.
     *
     * @param TItem $item  The element to search for.
     * @psalm-param TItem $item
     * @phpstan-param TItem $item
     *
     * @return int
     */
    public function indexOf(mixed $item): int
    {
        $index = array_search($item, $this->items);

        if ($index === false) {
            return -1;
        }

        return (int) $index;
    }

    /**
     * @inheritDoc
     */
    public function getIterator(): Traversable
    {
        yield from $this->items;
    }
}
