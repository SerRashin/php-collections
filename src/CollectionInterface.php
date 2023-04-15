<?php

declare(strict_types=1);

namespace Ser\Collections;

use Traversable;

/**
 * Collection interface.
 *
 * Base interface for all collections.
 *
 * @template TItem
 * @psalm-template TItem
 * @phpstan-template TItem
 *
 * @extends IEnumerable<array-key, TItem>
 * @template-extends IEnumerable<array-key, TItem>
 */
interface CollectionInterface extends IEnumerable
{
    /**
     * Get iterator
     *
     * @return Traversable<array-key, TItem>
     * @psalm-return Traversable<array-key, TItem>
     * @phpstan-return Traversable<array-key, TItem>
     */
    public function getIterator(): Traversable;
}
