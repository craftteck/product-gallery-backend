<?php

namespace Tests\Unit\Product;

use Mockery;
use Packages\Domain\Product\Product;
use Packages\Domain\Product\ProductRepositoryInterface;
use Packages\Usecase\Product\Update\UpdateProductCommand;
use Packages\Usecase\Product\Update\UpdateProductDto;
use Packages\Usecase\Product\Update\UpdateProductInteractor;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UpdateProductInteractorTest extends TestCase
{
    /**
     * プロダクトの更新処理実行
     */
    public function test_execute(): void
    {
        $command = new UpdateProductCommand(
            id: 1,
            userId: 1,
            name: 'updated name',
            summary: 'updated summary',
            description: 'updated description',
            url: 'updated url',
        );

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
                )
            );
        $updated = new Product(
            id: 1,
            userId: 1,
            name: 'updated name',
            summary: 'updated summary',
            description: 'updated description',
            url: 'updated url',
        );
        $repository
            ->expects($this->once())
            ->method('update')
            ->with($updated)
            ->willReturn($updated);

        $interactor = new UpdateProductInteractor($repository);
        $result = $interactor->execute($command);

        $expected = new UpdateProductDto(
            id: 1,
            userId: 1,
            name: 'updated name',
            summary: 'updated summary',
            description: 'updated description',
            url: 'updated url',
        );
        $this->assertEquals($expected, $result);
    }

    /**
     * 更新対象のプロダクトが存在しない場合
     */
    public function test_target_resource_not_found(): void
    {
        $command = new UpdateProductCommand(
            id: 1,
            userId: 1,
            name: 'updated name',
            summary: 'updated summary',
            description: 'updated description',
            url: 'updated url',
        );

        $repository = $this->createMock(ProductRepositoryInterface::class);
        $repository
            ->expects($this->once())
            ->method('findById')
            ->with($this->equalTo($command->id))
            ->willReturn(null);
        
        $this->expectException(NotFoundHttpException::class);
        $this->expectExceptionMessage('Target resource not found.');

        $interactor = new UpdateProductInteractor($repository);
        $interactor->execute($command);
    }
}
