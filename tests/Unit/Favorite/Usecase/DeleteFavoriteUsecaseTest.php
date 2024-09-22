<?php

namespace Tests\Unit\Favorite;

use Packages\Domain\Favorite\FavoriteRepositoryInterface;
use Packages\Usecase\Favorite\Delete\DeleteFavoriteUsecase;
use Packages\Usecase\Favorite\Delete\DeleteFavoriteUsecaseInput;
use PHPUnit\Framework\TestCase;

class DeleteFavoriteUsecaseTest extends TestCase
{
    public function test_execute(): void
    {
        $usecaseInput = new DeleteFavoriteUsecaseInput(
            ids: [1, 2, 3],
        );

        /** @var FavoriteRepositoryInterface&\PHPUnit\Framework\MockObject\MockObject $repository */
        $repository = $this->createMock(FavoriteRepositoryInterface::class);
        $repository
            ->expects($this->once())
            ->method('delete')
            ->with($this->equalTo($usecaseInput->ids));

        $usecase = new DeleteFavoriteUsecase($repository);
        $usecase->execute($usecaseInput);
    }
}
