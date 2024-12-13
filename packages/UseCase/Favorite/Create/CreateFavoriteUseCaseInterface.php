<?php

namespace Packages\UseCase\Favorite\Create;

/**
 * お気に入り登録のユースケースインターフェース
 */
interface CreateFavoriteUseCaseInterface
{
    public function execute(CreateFavoriteUseCaseInput $useCaseInput): CreateFavoriteUseCaseOutput;
}
