<?php

declare(strict_types=1);

namespace Ser\Collections\TestData;

use Ser\Collections\AbstractArray;
use Traversable;

class AbstractArrayFixture extends AbstractArray
{

    public function getIterator(): Traversable
    {
        yield from $this->items;
    }
}
