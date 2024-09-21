<?php

namespace Packages\Usecase\Favorite\Create;

/**
 * お気に入り登録のユースケースインターフェース
 */
interface CreateFavoriteUsecaseInterface
{
    public function execute(CreateFavoriteUsecaseInput $usecaseInput): CreateFavoriteUsecaseOutput;
}
