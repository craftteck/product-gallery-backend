<?php

namespace Tests\Unit\Favorite;

use Packages\Domain\Favorite\FavoriteRepositoryInterface;
use Packages\UseCase\Favorite\Delete\DeleteFavoriteCommand;
use Packages\UseCase\Favorite\Delete\DeleteFavoriteUseCase;
use PHPUnit\Framework\TestCase;

class DeleteFavoriteUseCaseTest extends TestCase
{
    public function test_execute(): void
    {
        $command = new DeleteFavoriteCommand(
            ids: [1, 2, 3],
        );

        /** @var FavoriteRepositoryInterface&\PHPUnit\Framework\MockObject\MockObject $repository */
        $repository = $this->createMock(FavoriteRepositoryInterface::class);
        $repository
            ->expects($this->once())
            ->method('delete')
            ->with($this->equalTo($command->ids));

        $useCase = new DeleteFavoriteUseCase($repository);
        $useCase->execute($command);
    }
}
