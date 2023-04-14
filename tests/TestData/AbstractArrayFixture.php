<?php

declare(strict_types=1);

namespace Ser\Generic\TestData;

use Ser\Generic\AbstractArray;
use Traversable;

class AbstractArrayFixture extends AbstractArray
{

    public function getIterator(): Traversable
    {
        yield from $this->items;
    }
}
