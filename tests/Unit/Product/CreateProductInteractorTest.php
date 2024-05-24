<?php

namespace Tests\Unit\Product;

use Mockery;
use Packages\Domain\Product\Product;
use Packages\Domain\Product\ProductRepositoryInterface;
use Packages\Usecase\Product\Create\CreateProductCommand;
use Packages\Usecase\Product\Create\CreateProductDto;
use Packages\Usecase\Product\Create\CreateProductInteractor;
use PHPUnit\Framework\TestCase;

class CreateProductInteractorTest extends TestCase
{
    /**
     * プロダクトの登録処理実行
     */
    public function test_execute(): void
    {
        $command = new CreateProductCommand(
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

        $interactor = new CreateProductInteractor($repository);
        $result = $interactor->execute($command);

        $expected = new CreateProductDto(
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
