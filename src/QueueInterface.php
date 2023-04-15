<?php

declare(strict_types=1);

namespace Ser\Collections;

/**
 * QueueInterface
 *
 * @template TItem
 * @psalm-template TItem
 * @phpstan-template TItem
 *
 * @extends CollectionInterface<TItem>
 * @template-extends CollectionInterface<TItem>
 */
interface QueueInterface extends CollectionInterface
{
    /**
     * Adds an item to the end of the queue
     *
     * @param TItem $item The object to add to the queue
     * @psalm-param TItem $item
     * @phpstan-param TItem $item
     *
     * @return void
     */
    public function enqueue(mixed $item): void;

    /**
     * Removes and returns the item at the beginning of the queue
     *
     * @return TItem|null
     * @psalm-return TItem|null
     * @phpstan-return TItem|null
     */
    public function dequeue(): mixed;

    /**
     * Returns the object at the beginning of the queue without removing it.
     *
     * @return TItem|null
     * @psalm-return TItem|null
     * @phpstan-return TItem|null
     */
    public function peek(): mixed;

    /**
     * Checks if collection contains item
     *
     * @param TItem $item
     * @psalm-param TItem $item
     * @phpstan-param TItem $item
     *
     * @return bool
     */
    public function contains(mixed $item): bool;

//    /**
//     * @param TItem $item
//     *
//     * @return bool
//     */
//    public function tryDequeue(mixed &$item): bool;

//    /**
//     * @param TItem $item
//     *
//     * @return bool
//     */
//    public function tryPeek(mixed &$item): bool;
}
