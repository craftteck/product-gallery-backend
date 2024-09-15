<?php

namespace Tests\Unit\Product;

use Mockery;
use Packages\Domain\Product\Product;
use Packages\Domain\Product\ProductRepositoryInterface;
use Packages\Usecase\Product\Create\CreateProductUsecaseInput;
use Packages\Usecase\Product\Create\CreateProductUsecaseOutput;
use Packages\Usecase\Product\Create\CreateProductUsecase;
use PHPUnit\Framework\TestCase;

class CreateProductUsecaseTest extends TestCase
{
    /**
     * プロダクトの登録処理実行
     */
    public function test_execute(): void
    {
        $usecaseInput = new CreateProductUsecaseInput(
            userId: 1,
            name: 'name',
            summary: 'summary',
            description: 'description',
            url: 'url',
        );

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
                )
            );

        $usecase = new CreateProductUsecase($repository);
        $result = $usecase->execute($usecaseInput);

        $expected = new CreateProductUsecaseOutput(
            id: 1,
            userId: 1,
            name: 'name',
            summary: 'summary',
            description: 'description',
            url: 'url',
        );
        $this->assertEquals($expected, $result);
    }
}
