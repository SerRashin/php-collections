<?php

declare(strict_types=1);

namespace Ser\Collections;

use Traversable, Countable, IteratorAggregate;

/**
 * Enumeration interface.
 *
 * Base interface for all enumerations.
 *
 * @template TKey
 * @psalm-template TKey
 * @phpstan-template TKey
 *
 * @template TItem
 * @psalm-template TItem
 * @phpstan-template TItem
 *
 * @template-extends IteratorAggregate<TKey, TItem>
 * @extends IteratorAggregate<TKey, TItem>
 */
interface IEnumerable extends Countable, IteratorAggregate
{
    /**
     * Is collection empty
     *
     * @return bool
     */
    public function isEmpty(): bool;

    /**
     * Get iterator
     *
     * @return Traversable<TKey, TItem>
     * @psalm-return Traversable<TKey, TItem>
     * @phpstan-return Traversable<TKey, TItem>
     */
    public function getIterator(): Traversable;
}
