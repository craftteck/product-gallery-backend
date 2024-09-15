<?php

namespace Tests\Unit\Product;

use Packages\Domain\Product\Product;
use Packages\Domain\Product\ProductRepositoryInterface;
use Packages\Usecase\Product\Read\ReadProductUsecase;
use Packages\Usecase\Product\Read\ReadProductUsecaseInput;
use Packages\Usecase\Product\Read\ReadProductUsecaseOutput;
use PHPUnit\Framework\TestCase;

class ReadProductUsecaseTest extends TestCase
{
    /**
     * プロダクトの取得処理実行
     */
    public function test_execute(): void
    {
        $usecaseInput = new ReadProductUsecaseInput(id: 1);

        $repository = $this->createMock(ProductRepositoryInterface::class);
        $repository
            ->expects($this->once())
            ->method('findById')
            ->with($this->equalTo($usecaseInput->id))
            ->willReturn(
                new Product(
                    id: 1,
                    userId: 1,
                    name: 'name',
                    summary: 'summary',
                    description: 'description',
                    url: 'url',
                    version: 1,
                )
            );

        $usecase = new ReadProductUsecase($repository);
        $result = $usecase->execute($usecaseInput);

        $expected = new ReadProductUsecaseOutput(
            id: 1,
            userId: 1,
            name: 'name',
            summary: 'summary',
            description: 'description',
            url: 'url',
            version: 1,
        );
        $this->assertEquals($expected, $result);
    }
}
