<?php

declare(strict_types=1);

namespace Ser\Collections;

use OutOfRangeException;
use RuntimeException;
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
     * @return Traversable<TKey, TItem>
     */
    public function getIterator(): Traversable
    {
        foreach ($this->items as $item) {
            yield $item->key => $item->value;
        }
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
        return isset($this->items[Hasher::hash($offset)]);
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
        $hashKey = Hasher::hash($offset);

        if (!isset($this->items[$hashKey])) {
            return null;
        }

        return $this->items[$hashKey]->value;
    }

    /**
     * Required by interface ArrayAccess.
     *
     * @param TKey $offset
     * @psalm-param TKey $offset
     * @phpstan-param TKey $offset
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
            throw new RuntimeException(Errors::DICTIONARY_KEY_NOT_SET);
        }

        $hashKey = Hasher::hash($offset);

        $this->items[$hashKey] = new KeyValuePair($offset, $value);
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
        return $this->containsValue($item);
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
