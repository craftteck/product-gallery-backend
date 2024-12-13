<?php

namespace Packages\UseCase\Favorite\Delete;

/**
 * お気に入り削除のユースケースインターフェース
 */
interface DeleteFavoriteUseCaseInterface
{
    public function execute(DeleteFavoriteUseCaseInput $useCaseInput): void;
}
