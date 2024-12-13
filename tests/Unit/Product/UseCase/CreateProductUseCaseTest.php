<?php

namespace Tests\Unit\Product;

use Packages\Domain\Product\Product;
use Packages\Domain\Product\ProductRepositoryInterface;
use Packages\UseCase\Product\Create\CreateProductUseCase;
use Packages\UseCase\Product\Create\CreateProductUseCaseInput;
use Packages\UseCase\Product\Create\CreateProductUseCaseOutput;
use PHPUnit\Framework\TestCase;

class CreateProductUseCaseTest extends TestCase
{
    /**
     * プロダクトの登録処理実行
     */
    public function test_execute(): void
    {
        $useCaseInput = new CreateProductUseCaseInput(
            userId: 1,
            name: 'name',
            summary: 'summary',
            description: 'description',
            url: 'url',
        );

        /** @var ProductRepositoryInterface&\PHPUnit\Framework\MockObject\MockObject $repository */
        $repository = $this->createMock(ProductRepositoryInterface::class);
        $repository
            ->expects($this->once())
            ->method('insert')
            ->with($this->equalTo(
                new Product(
                    id: null,
                    userId: 1,
                    name: 'name',
                    summary: 'summary',
                    description: 'description',
                    url: 'url',
                    version: null,
                )
            ))
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

        $useCase = new CreateProductUseCase($repository);
        $result = $useCase->execute($useCaseInput);

        $expected = new CreateProductUseCaseOutput(
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
