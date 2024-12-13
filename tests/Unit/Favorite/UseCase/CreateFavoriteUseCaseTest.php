<?php

namespace Tests\Unit\Favorite;

use Packages\Domain\Favorite\Favorite;
use Packages\Domain\Favorite\FavoriteRepositoryInterface;
use Packages\UseCase\Favorite\Create\CreateFavoriteUseCase;
use Packages\UseCase\Favorite\Create\CreateFavoriteUseCaseInput;
use Packages\UseCase\Favorite\Create\CreateFavoriteUseCaseOutput;
use PHPUnit\Framework\TestCase;

class CreateFavoriteUseCaseTest extends TestCase
{
    /**
     * プロダクトの登録処理実行
     */
    public function test_execute(): void
    {
        $useCaseInput = new CreateFavoriteUseCaseInput(
            userId: 1,
            productId: 1,
        );

        /** @var FavoriteRepositoryInterface&\PHPUnit\Framework\MockObject\MockObject $repository */
        $repository = $this->createMock(FavoriteRepositoryInterface::class);
        $repository
            ->expects($this->once())
            ->method('insert')
            ->with($this->equalTo(
                new Favorite(
                    id: null,
                    userId: 1,
                    productId: 1,
                    version: null,
                )
            ))
            ->willReturn(
                new Favorite(
                    id: 1,
                    userId: 1,
                    productId: 1,
                    version: 1,
                )
            );

        $useCase = new CreateFavoriteUseCase($repository);
        $result = $useCase->execute($useCaseInput);

        $expected = new CreateFavoriteUseCaseOutput(
            id: 1,
            userId: 1,
            productId: 1,
            version: 1,
        );
        $this->assertEquals($expected, $result);
    }
}
