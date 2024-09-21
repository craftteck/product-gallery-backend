<?php

namespace Packages\Usecase\Favorite\Create;

/**
 * お気に入り登録のDTOクラス
 */
final readonly class CreateFavoriteUsecaseOutput
{
    /**
     * コンストラクタ
     *
     * @param int $id
     * @param int $userId
     * @param int $productId
     * @param int $version
     */
    public function __construct(
        public int $id,
        public int $userId,
        public int $productId,
        public int $version,
    ) {
    }
}
