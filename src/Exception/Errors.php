<?php

declare(strict_types=1);

namespace Ser\Collections\Exception;

class Errors
{
    public const OUT_OF_RANGE = 'Index was out of range. Must be non-negative and less than the size of the collection.';
    public const DICTIONARY_KEY_NOT_SET = 'Dictionary key not set';
}
