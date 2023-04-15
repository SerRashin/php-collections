<?php

declare(strict_types=1);

namespace Ser\Collections\Utils;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use RuntimeException;
use Ser\Collections\TestData\Section;
use stdClass;

class HasherTest extends TestCase
{
    public function testHasherNotSupportsType(): void
    {
        $this->expectException(RuntimeException::class);
        Hasher::hash(tmpfile());
    }

    #[DataProvider('scalarKeysProvider')]
    public function testScalarHash(mixed $key): void
    {
        $this->assertEquals($key, Hasher::hash($key));
    }

    #[DataProvider('objectKeysProvider')]
    public function testObjectHash(object $key): void
    {
        $this->assertEquals(spl_object_hash($key), Hasher::hash($key));
    }

    /**
     * @param array<string> $array
     * @return void
     */
    #[DataProvider('arrayKeysProvider')]
    public function testArrayHash(array $array = []): void
    {
        $this->assertEquals(md5(serialize($array)) . '_a', Hasher::hash($array));
    }

    /**
     * @return array<array<scalar>>
     */
    public static function scalarKeysProvider(): array
    {
        return [
            [1,],
            [0.002,],
            ['some',],
            [false,],
        ];
    }

    /**
     * @return array<array<object>>
     */
    public static function objectKeysProvider(): array
    {
        return [
            [new StdClass()],
            [new Section('name1')],
            [new Section('name2')],
        ];
    }

    /**
     * @return array<array<array<string|int|object>>>
     */
    public static function arrayKeysProvider(): array
    {
        return [
            [ array(1, 2, 3) ],
            [ array(new Section('name1'), 123) ],
            [ array(new Section('name2')) ],
            [ array('string', new Section('name2'), 123) ],
        ];
    }
}
