<?php

namespace Packages\UseCase\Favorite\Create;

/**
 * お気に入り登録のコマンド
 */
readonly class RegisterFavoriteCommand
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
