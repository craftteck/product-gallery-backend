<?php

namespace Tests\Unit\Favorite;

use Packages\Domain\Favorite\Favorite;
use Packages\Domain\Favorite\FavoriteRepositoryInterface;
use Packages\Usecase\Favorite\Create\CreateFavoriteUsecase;
use Packages\Usecase\Favorite\Create\CreateFavoriteUsecaseInput;
use Packages\Usecase\Favorite\Create\CreateFavoriteUsecaseOutput;
use PHPUnit\Framework\TestCase;

class CreateFavoriteUsecaseTest extends TestCase
{
    /**
     * プロダクトの登録処理実行
     */
    public function test_execute(): void
    {
        $usecaseInput = new CreateFavoriteUsecaseInput(
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

        $usecase = new CreateFavoriteUsecase($repository);
        $result = $usecase->execute($usecaseInput);

        $expected = new CreateFavoriteUsecaseOutput(
            id: 1,
            userId: 1,
            productId: 1,
            version: 1,
        );
        $this->assertEquals($expected, $result);
    }
}
