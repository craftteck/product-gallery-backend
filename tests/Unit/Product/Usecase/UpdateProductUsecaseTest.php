<?php

namespace Tests\Unit\Product;

use Packages\Domain\Product\Product;
use Packages\Domain\Product\ProductRepositoryInterface;
use Packages\Usecase\Product\Update\UpdateProductUsecase;
use Packages\Usecase\Product\Update\UpdateProductUsecaseInput;
use Packages\Usecase\Product\Update\UpdateProductUsecaseOutput;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UpdateProductUsecaseTest extends TestCase
{
    /**
     * プロダクトの更新処理実行
     */
    public function test_execute(): void
    {
        $usecaseInput = new UpdateProductUsecaseInput(
            id: 1,
            userId: 1,
            name: 'updated name',
            summary: 'updated summary',
            description: 'updated description',
            url: 'updated url',
            version: 2,
        );

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
        $updated = new Product(
            id: 1,
            userId: 1,
            name: 'updated name',
            summary: 'updated summary',
            description: 'updated description',
            url: 'updated url',
            version: 2,
        );
        $repository
            ->expects($this->once())
            ->method('update')
            ->with($updated)
            ->willReturn($updated);

        $usecase = new UpdateProductUsecase($repository);
        $result = $usecase->execute($usecaseInput);

        $expected = new UpdateProductUsecaseOutput(
            id: 1,
            userId: 1,
            name: 'updated name',
            summary: 'updated summary',
            description: 'updated description',
            url: 'updated url',
            version: 2,
        );
        $this->assertEquals($expected, $result);
    }

    /**
     * 更新対象のプロダクトが存在しない場合
     */
    public function test_target_resource_not_found(): void
    {
        $usecaseInput = new UpdateProductUsecaseInput(
            id: 1,
            userId: 1,
            name: 'updated name',
            summary: 'updated summary',
            description: 'updated description',
            url: 'updated url',
            version: 2,
        );

        $repository = $this->createMock(ProductRepositoryInterface::class);
        $repository
            ->expects($this->once())
            ->method('findById')
            ->with($this->equalTo($usecaseInput->id))
            ->willReturn(null);

        $this->expectException(NotFoundHttpException::class);
        $this->expectExceptionMessage('Target resource not found.');

        $usecase = new UpdateProductUsecase($repository);
        $usecase->execute($usecaseInput);
    }
}
