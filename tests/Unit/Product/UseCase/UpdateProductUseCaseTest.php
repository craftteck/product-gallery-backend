<?php

namespace Tests\Unit\Product;

use Packages\Domain\Product\Product;
use Packages\Domain\Product\ProductRepositoryInterface;
use Packages\UseCase\Product\Update\UpdateProductUseCase;
use Packages\UseCase\Product\Update\UpdateProductUseCaseInput;
use Packages\UseCase\Product\Update\UpdateProductUseCaseOutput;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UpdateProductUseCaseTest extends TestCase
{
    /**
     * プロダクトの更新処理実行
     */
    public function test_execute(): void
    {
        $useCaseInput = new UpdateProductUseCaseInput(
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
            ->with($this->equalTo($useCaseInput->id))
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

        /** @var ProductRepositoryInterface&\PHPUnit\Framework\MockObject\MockObject $repository */
        $useCase = new UpdateProductUseCase($repository);
        $result = $useCase->execute($useCaseInput);

        $expected = new UpdateProductUseCaseOutput(
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
        $useCaseInput = new UpdateProductUseCaseInput(
            id: 1,
            userId: 1,
            name: 'updated name',
            summary: 'updated summary',
            description: 'updated description',
            url: 'updated url',
            version: 2,
        );

        /** @var ProductRepositoryInterface&\PHPUnit\Framework\MockObject\MockObject $repository */
        $repository = $this->createMock(ProductRepositoryInterface::class);
        $repository
            ->expects($this->once())
            ->method('findById')
            ->with($this->equalTo($useCaseInput->id))
            ->willReturn(null);

        $this->expectException(NotFoundHttpException::class);
        $this->expectExceptionMessage('Target resource not found.');

        $useCase = new UpdateProductUseCase($repository);
        $useCase->execute($useCaseInput);
    }
}
