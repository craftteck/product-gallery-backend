<?php

namespace Packages\UseCase\Favorite\Delete;

use Packages\Domain\Favorite\FavoriteRepositoryInterface;

/**
 * お気に入り削除のユースケースクラス
 */
readonly class DeleteFavoriteUseCase
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
     * @param DeleteFavoriteCommand $command
     */
    public function execute(DeleteFavoriteCommand $command): void
    {
        $this->repository->delete($command->ids);
    }
}
