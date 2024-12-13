<?php

namespace Packages\UseCase\Favorite\Delete;

use Packages\Domain\Favorite\FavoriteRepositoryInterface;

/**
 * お気に入り削除のユースケースクラス
 */
final readonly class DeleteFavoriteUseCase implements DeleteFavoriteUseCaseInterface
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
     * @param DeleteFavoriteUseCaseInput $useCaseInput
     */
    public function execute(DeleteFavoriteUseCaseInput $useCaseInput): void
    {
        $this->repository->delete($useCaseInput->ids);
    }
}
