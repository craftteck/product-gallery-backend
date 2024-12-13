<?php

namespace Tests\Unit\Favorite;

use Packages\Domain\Favorite\FavoriteRepositoryInterface;
use Packages\UseCase\Favorite\Delete\DeleteFavoriteUseCase;
use Packages\UseCase\Favorite\Delete\DeleteFavoriteUseCaseInput;
use PHPUnit\Framework\TestCase;

class DeleteFavoriteUseCaseTest extends TestCase
{
    public function test_execute(): void
    {
        $useCaseInput = new DeleteFavoriteUseCaseInput(
            ids: [1, 2, 3],
        );

        /** @var FavoriteRepositoryInterface&\PHPUnit\Framework\MockObject\MockObject $repository */
        $repository = $this->createMock(FavoriteRepositoryInterface::class);
        $repository
            ->expects($this->once())
            ->method('delete')
            ->with($this->equalTo($useCaseInput->ids));

        $useCase = new DeleteFavoriteUseCase($repository);
        $useCase->execute($useCaseInput);
    }
}
