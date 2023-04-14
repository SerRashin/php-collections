<?php

declare(strict_types=1);

namespace Ser\Generic;

use ArrayAccess, Countable, IteratorAggregate;

/**
 * Array interface
 *
 * @template TKey
 * @psalm-template TKey
 * @phpstan-template TKey
 *
 * @template TItem
 * @psalm-template TItem
 * @phpstan-template TItem
 *
 * @template-extends ArrayAccess<TKey, TItem>
 * @template-extends IteratorAggregate<TKey, TItem>
 * @extends ArrayAccess<TKey, TItem>
 * @extends IteratorAggregate<TKey, TItem>
 */
interface ArrayInterface extends ArrayAccess, Countable, IteratorAggregate
{
    /**
     * Clears the collection, removing all elements.
     *
     * @return void
     */
    public function clear(): void;

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

    /**
     * Is collection empty
     *
     * @return bool
     */
    public function isEmpty(): bool;
}
