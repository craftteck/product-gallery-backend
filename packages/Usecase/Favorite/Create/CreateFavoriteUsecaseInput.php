<?php

namespace Packages\Usecase\Favorite\Create;

/**
 * お気に入り登録のユースケースインプット
 */
final readonly class CreateFavoriteUsecaseInput
{
    /**
     * コンストラクタ
     *
     * @param int $userId
     * @param int $productId
     */
    public function __construct(
        public int $userId,
        public int $productId,
    ) {
    }
}
