<?php

declare(strict_types=1);

namespace Ser\Collections;

use Ser\Collections\Utils\Iterating;
use Traversable;

/**
 * Collection
 *
 * @template TItem
 * @psalm-template TItem
 * @phpstan-template TItem
 *
 * @implements CollectionInterface<TItem>
 * @template-implements CollectionInterface<TItem>
 */
class Collection implements CollectionInterface
{
    /**
     * @var array<array-key, TItem>
     */
    protected array $items;

    /**
     * @param iterable<array-key, TItem> $items
     */
    public function __construct(iterable $items = [])
    {
        $this->items = Iterating::toArray($items);
    }

    /**
     * @inheritDoc
     *
     * @return int<0, max>
     */
    public function count(): int
    {
        return count($this->items);
    }

    /**
     * Is collection empty
     *
     * @return bool
     */
    public function isEmpty(): bool
    {
        return empty($this->items);
    }

    /**
     * Get iterator
     *
     * @return Traversable<array-key, TItem>
     * @psalm-return Traversable<array-key, TItem>
     * @phpstan-return Traversable<array-key, TItem>
     */
    public function getIterator(): Traversable
    {
        yield from $this->items;
    }
}
