<?php

namespace Tests\Unit\Product;

use Packages\Domain\Product\ProductRepositoryInterface;
use Packages\Usecase\Product\Delete\DeleteProductUsecase;
use Packages\Usecase\Product\Delete\DeleteProductUsecaseInput;
use PHPUnit\Framework\TestCase;

class DeleteProductUsecaseTest extends TestCase
{
    public function test_execute(): void
    {
        $usecaseInput = new DeleteProductUsecaseInput(
            ids: [1, 2, 3],
        );

        /** @var ProductRepositoryInterface&\PHPUnit\Framework\MockObject\MockObject $repository */
        $repository = $this->createMock(ProductRepositoryInterface::class);
        $repository
            ->expects($this->once())
            ->method('delete')
            ->with($this->equalTo($usecaseInput->ids));

        $usecase = new DeleteProductUsecase($repository);
        $usecase->execute($usecaseInput);
    }
}
