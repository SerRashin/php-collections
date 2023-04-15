<?php

declare(strict_types=1);

namespace Ser\Collections;

/**
 * StackInterface
 *
 * @template TItem
 * @psalm-template TItem
 * @phpstan-template TItem
 *
 * @extends CollectionInterface<TItem>
 * @template-extends CollectionInterface<TItem>
 */
interface StackInterface extends CollectionInterface
{
    /**
     * Inserts an object at the top of the stack.
     *
     * @param TItem $item The object to push onto the stack
     * @psalm-param TItem $item
     * @phpstan-param TItem $item
     *
     * @return void
     */
    public function push(mixed $item): void;

    /**
     * Removes and returns the object at the top of the stack.
     *
     * @return TItem
     * @psalm-return TItem
     * @phpstan-return TItem
     */
    public function pop(): mixed;

    /**
     * Returns the object at the top of the stack without removing it.
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
//    public function tryPop(mixed &$item): bool;
//
//    /**
//     * @param TItem $item
//     *
//     * @return bool
//     */
//    public function tryPeek(mixed &$item): bool;
}
