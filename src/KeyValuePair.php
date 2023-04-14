<?php

declare(strict_types=1);

namespace Ser\Generic;

/**
 * @template TKey
 * @psalm-template TKey
 * @phpstan-template TKey
 *
 * @template TItem
 * @psalm-template TItem
 * @phpstan-template TItem
 */
class KeyValuePair
{
    /**
     * Create key value pair
     *
     * @param TKey  $key
     * @param TItem $value
     */
    public function __construct(
        public readonly mixed $key,
        public readonly mixed $value,
    ) {
    }
}
