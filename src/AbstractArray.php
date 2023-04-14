<?php

declare(strict_types=1);

namespace Ser\Generic;

use Ser\Generic\Utils\Iterating;

/**
 * Abstract interface
 *
 * @template TKey
 * @psalm-template TKey
 * @phpstan-template TKey
 *
 * @template TItem
 * @psalm-template TItem
 * @phpstan-template TItem
 *
 * @implements ArrayInterface<TKey, TItem>
 * @template-implements ArrayInterface<TKey, TItem>
 */
abstract class AbstractArray implements ArrayInterface
{
    /**
     * @var array<array-key, TItem>
     */
    protected array $items;

    /**
     * @param iterable<TItem> $items
     */
    public function __construct(iterable $items = [])
    {
        $this->items = Iterating::toArray($items);
    }

    /**
     * Required by interface ArrayAccess.
     *
     * @param TKey $offset
     * @psalm-param TKey $offset
     * @phpstan-param TKey $offset
     *
     * @return bool
     */
    public function offsetExists(mixed $offset): bool
    {
        return isset($this->items[$offset]);
    }

    /**
     * Required by interface ArrayAccess.
     *
     * @param TKey $offset
     * @psalm-param TKey $offset
     * @phpstan-param TKey $offset
     *
     * @return TItem|null
     * @psalm-return TItem|null
     * @phpstan-return TItem|null
     */
    public function offsetGet(mixed $offset): mixed
    {
        if (!isset($this->items[$offset])) {
            return null;
        }

        return $this->items[$offset];
    }

    /**
     * Required by interface ArrayAccess.
     *
     * @param array-key|null $offset
     * @psalm-param array-key|null $offset
     * @phpstan-param array-key|null $offset
     *
     * @param TItem          $value
     * @psalm-param TItem          $value
     * @phpstan-param TItem          $value
     *
     * @return void
     */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        if ($offset === null) {
            $this->items[] = $value;
        } else {
            $this->items[$offset] = $value;
        }
    }

    /**
     * Required by interface ArrayAccess.
     *
     * @param TKey $offset
     * @psalm-param TKey $offset
     * @phpstan-param TKey $offset
     *
     * @return void
     */
    public function offsetUnset(mixed $offset): void
    {
        unset($this->items[$offset]);
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
     * Clears the collection, removing all elements.
     *
     * @return void
     */
    public function clear(): void
    {
        $this->items = [];
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
        return in_array($item, $this->items, true);
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
}
