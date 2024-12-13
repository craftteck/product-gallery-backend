<?php

namespace Tests\Unit\Product;

use Packages\Domain\Product\Product;
use Packages\Domain\Product\ProductRepositoryInterface;
use Packages\UseCase\Product\ProductDto;
use Packages\UseCase\Product\Read\ReadProductCommand;
use Packages\UseCase\Product\Read\ReadProductUseCase;
use PHPUnit\Framework\TestCase;

class ReadProductUseCaseTest extends TestCase
{
    /**
     * プロダクトの取得処理実行
     */
    public function test_execute(): void
    {
        $command = new ReadProductCommand(id: 1);

        $repository = $this->createMock(ProductRepositoryInterface::class);
        $repository
            ->expects($this->once())
            ->method('findById')
            ->with($this->equalTo($command->id))
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

        $useCase = new ReadProductUseCase($repository);
        $result = $useCase->execute($command);

        $expected = new ProductDto(
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
