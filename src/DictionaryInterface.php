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
 * @extends ReadOnlyDictionaryInterface<TKey, TItem>
 * @template-extends ReadOnlyDictionaryInterface<TKey, TItem>
 *
 * @extends IEnumerable<TKey, TItem>
 * @template-extends IEnumerable<TKey, TItem>
 */
interface DictionaryInterface extends ReadOnlyDictionaryInterface, IEnumerable
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
     * Remove element from dictionary
     *
     * @param TKey $key
     * @psalm-param TKey $key
     * @phpstan-param TKey $key
     *
     * @return void
     */
    public function remove(mixed $key): void;
}
