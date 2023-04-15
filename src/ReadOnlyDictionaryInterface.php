<?php

declare(strict_types=1);

namespace Ser\Collections;

/**
 * Read-only dictionary interface
 *
 * @template TKey
 * @psalm-template TKey
 * @phpstan-template TKey
 *
 * @template TItem
 * @psalm-template TItem
 * @phpstan-template TItem
 */
interface ReadOnlyDictionaryInterface
{
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
