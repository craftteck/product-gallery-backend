<?php

namespace Packages\Usecase\Favorite\Delete;

/**
 * お気に入り削除のユースケースインターフェース
 */
interface DeleteFavoriteUsecaseInterface
{
    public function execute(DeleteFavoriteUsecaseInput $usecaseInput): void;
}
