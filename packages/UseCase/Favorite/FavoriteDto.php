<?php

namespace Packages\UseCase\Favorite;

/**
 * お気に入り登録のDTOクラス
 */
final readonly class FavoriteDto
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
