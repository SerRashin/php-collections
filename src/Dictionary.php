<?php

declare(strict_types=1);

namespace Ser\Collections;

use OutOfRangeException;
use Ser\Collections\Exception\Errors;
use Ser\Collections\Utils\Hasher;
use Traversable;

/**
 * Collection interface
 *
 * @template TKey
 * @psalm-template TKey
 * @phpstan-template TKey
 *
 * @template TItem
 * @psalm-template TItem
 * @phpstan-template TItem
 *
 *
 * @implements DictionaryInterface<TKey, TItem>
 * @template-implements DictionaryInterface<TKey, TItem>
 */
class Dictionary implements DictionaryInterface
{
    /**
     * @var array<array-key, KeyValuePair<TKey,TItem>>
     */
    private array $items;

    public function __construct() {
        $this->items = [];
    }

    /**
     * Add element to the key-value collection
     *
     * @param TKey $key
     * @param TItem $value
     *
     * @psalm-param TKey $key
     * @psalm-param TItem $value
     *
     * @phpstan-param TKey $key
     * @phpstan-param TItem $value
     *
     * @return void
     */
    public function add(mixed $key, mixed $value): void
    {
        $this->items[Hasher::hash($key)] = new KeyValuePair($key, $value);
    }

    /**
     * Get element from key-value collection
     *
     * @param TKey $key
     * @psalm-param TKey $key
     * @phpstan-param TKey $key
     *
     * @return TItem|null
     */
    public function get(mixed $key): mixed
    {
        $hashKey = Hasher::hash($key);

        if (!isset($this->items[$hashKey])) {
            return null;
        }

        return $this->items[$hashKey]->value;
    }

    /**
     * Remove element from dictionary
     *
     * @param TKey $key
     * @psalm-param TKey $key
     * @phpstan-param TKey $key
     *
     * @return void
     */
    public function remove(mixed $key): void
    {
        $hashKey = Hasher::hash($key);

        if (!isset($this->items[$hashKey])) {
            throw new OutOfRangeException(Errors::OUT_OF_RANGE);
        }

        unset($this->items[$hashKey]);
    }

    /**
     * Checks if collection has key
     *
     * @param TKey $key
     * @psalm-param TKey $key
     * @phpstan-param TKey $key
     *
     * @return bool
     */
    public function containsKey(mixed $key): bool
    {
        return isset($this->items[Hasher::hash($key)]);
    }

    /**
     * @param TItem $item
     *
     * @return bool
     */
    public function containsValue(mixed $item): bool
    {
        foreach ($this->items as $entry) {
            if ($entry->value === $item) {
                return true;
            }
        }

        return false;
    }

    public function getKeys(): Collection
    {
        $keys = [];
        foreach ($this->items as $item) {
            $keys[] = $item->key;
        }
        return new Collection($keys);
    }

    public function getValues(): Collection
    {
        $values = [];
        foreach ($this->items as $item) {
            $values[] = $item->value;
        }

        return new Collection($values);
    }

    /**
     * Get iterator
     *
     * @return Traversable<TKey, TItem>
     * @psalm-return Traversable<TKey, TItem>
     * @phpstan-return Traversable<TKey, TItem>
     */
    public function getIterator(): Traversable
    {
        foreach ($this->items as $item) {
            yield $item->key => $item->value;
        }
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
}
