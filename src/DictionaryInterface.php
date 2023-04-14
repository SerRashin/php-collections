<?php

declare(strict_types=1);

namespace Ser\Collections;

/**
 * Dictionary interface
 *
 * HashMap dictionary
 *
 * @template TKey
 * @psalm-template TKey
 * @phpstan-template TKey
 *
 * @template TItem
 * @psalm-template TItem
 * @phpstan-template TItem
 *
 * @template-extends ArrayInterface<TKey, TItem>
 */
interface DictionaryInterface extends ArrayInterface
{
    /**
     * Add element to dictionary
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
    public function add(mixed $key, mixed $value): void;

    /**
     * Get element from dictionary
     *
     * @param TKey $key
     * @psalm-param TKey $key
     * @phpstan-param TKey $key
     *
     * @return TItem|null
     */
    public function get(mixed $key): mixed;

    /**
     * Remove element from dictionary
     *
     * @param TKey $key
     * @psalm-param TKey $key
     * @phpstan-param TKey $key
     *
     * @return void
     */
    public function remove(mixed $key): void;

    /**
     * Checks if dictionary has key
     *
     * @param TKey $key
     * @psalm-param TKey $key
     * @phpstan-param TKey $key
     *
     * @return bool
     */
    public function containsKey(mixed $key): bool;

    /**
     * Checks if dictionary contains value
     *
     * @param TItem $item
     * @psalm-param TItem $item
     * @phpstan-param TItem $item
     *
     * @return bool
     */
    public function containsValue(mixed $item): bool;

    /**
     * Get collection of keys
     *
     * @return Collection<TKey>
     */
    public function getKeys(): Collection;

    /**
     * Get collection of values
     *
     * @return Collection<TItem>
     */
    public function getValues(): Collection;
}
