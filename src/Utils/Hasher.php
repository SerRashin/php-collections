<?php

declare(strict_types=1);

namespace Ser\Generic\Utils;

use RuntimeException;

class Hasher
{
    /**
     * Get hash for object
     *
     * @param mixed $key
     *
     * @return string
     */
    public static function hash(mixed $key): string
    {
        if (is_scalar($key)) {
            return (string) $key;
        }

        if (is_object($key)) {
            return spl_object_hash($key);
        }

        if (is_array($key)) {
            return md5(serialize($key)) . '_a';
        }

        $key = (string)$key;
        throw new RuntimeException("The type of $key is not supported");
    }
}
