<?php

namespace Tests\Unit\Product;

use Packages\Domain\Product\ProductRepositoryInterface;
use Packages\Usecase\Product\Delete\DeleteProductCommand;
use Packages\Usecase\Product\Delete\DeleteProductInteractor;
use PHPUnit\Framework\TestCase;

class DeleteProductInteractorTest extends TestCase
{
    public function test_execute(): void
    {
        $command = new DeleteProductCommand(
            ids: [1, 2, 3],
        );

        $repository = $this->createMock(ProductRepositoryInterface::class);
        $repository
            ->expects($this->once())
            ->method('delete')
            ->with($this->equalTo($command->ids));

        $interactor = new DeleteProductInteractor($repository);
        $interactor->execute($command);
    }
}
