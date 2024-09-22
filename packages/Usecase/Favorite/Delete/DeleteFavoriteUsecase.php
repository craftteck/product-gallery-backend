<?php

namespace Packages\Usecase\Favorite\Delete;

use Packages\Domain\Favorite\FavoriteRepositoryInterface;

/**
 * お気に入り削除のユースケースクラス
 */
final readonly class DeleteFavoriteUsecase implements DeleteFavoriteUsecaseInterface
{
    /**
     * コンストラクタ
     *
     * @param FavoriteRepositoryInterface $repository
     */
    public function __construct(
        private FavoriteRepositoryInterface $repository,
    ) {
    }

    /**
     * お気に入りを削除する
     *
     * @param DeleteFavoriteUsecaseInput $usecaseInput
     */
    public function execute(DeleteFavoriteUsecaseInput $usecaseInput): void
    {
        $this->repository->delete($usecaseInput->ids);
    }
}
