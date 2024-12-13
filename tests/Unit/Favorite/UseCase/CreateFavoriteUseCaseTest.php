<?php

namespace Tests\Unit\Favorite;

use Packages\Domain\Favorite\Favorite;
use Packages\Domain\Favorite\FavoriteRepositoryInterface;
use Packages\UseCase\Favorite\Create\CreateFavoriteUseCase;
use Packages\UseCase\Favorite\Create\RegisterFavoriteCommand;
use Packages\UseCase\Favorite\FavoriteDto;
use PHPUnit\Framework\TestCase;

class CreateFavoriteUseCaseTest extends TestCase
{
    /**
     * プロダクトの登録処理実行
     */
    public function test_execute(): void
    {
        $command = new RegisterFavoriteCommand(
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
        $result = $useCase->execute($command);

        $expected = new FavoriteDto(
            id: 1,
            userId: 1,
            productId: 1,
            version: 1,
        );
        $this->assertEquals($expected, $result);
    }
}
