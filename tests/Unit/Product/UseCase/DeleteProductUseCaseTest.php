<?php

namespace Tests\Unit\Product;

use Packages\Domain\Product\ProductRepositoryInterface;
use Packages\UseCase\Product\Delete\DeleteProductCommand;
use Packages\UseCase\Product\Delete\DeleteProductUseCase;
use PHPUnit\Framework\TestCase;

class DeleteProductUseCaseTest extends TestCase
{
    public function test_execute(): void
    {
        $command = new DeleteProductCommand(
            ids: [1, 2, 3],
        );

        /** @var ProductRepositoryInterface&\PHPUnit\Framework\MockObject\MockObject $repository */
        $repository = $this->createMock(ProductRepositoryInterface::class);
        $repository
            ->expects($this->once())
            ->method('delete')
            ->with($this->equalTo($command->ids));

        $useCase = new DeleteProductUseCase($repository);
        $useCase->execute($command);
    }
}
