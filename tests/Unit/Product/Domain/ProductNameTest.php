<?php

namespace Tests\Unit\Product\Domain;

use Packages\Domain\Product\ProductName;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class ProductNameTest extends TestCase
{
    #[Test]
    #[DataProvider('correctProductNameStringProvider')]
    public function プロダクト名は1文字以上、100文字以下であること(string $productNameString): void
    {
        $productName = new ProductName($productNameString);

        $this->assertSame($productNameString, $productName->value);
    }

    /**
     * @return array<string[]>
     */
    public static function correctProductNameStringProvider(): array
    {
        return [
            ['a'],
            [str_repeat('a', 100)],
        ];
    }

    #[Test]
    #[DataProvider('incorrectProductNameStringProvider')]
    public function プロダクト名が空文字または101文字以上の場合、エラーが発生する(string $productNameString): void
    {
        $this->expectException(\InvalidArgumentException::class);
        new ProductName($productNameString);
    }

    /**
     * @return array<string[]>
     */
    public static function incorrectProductNameStringProvider(): array
    {
        return [
            [''],
            [str_repeat('a', 101)],
        ];
    }
}
