<?php

namespace Packages\UseCase\Favorite\Delete;

/**
 * お気に入り削除のコマンド
 */
final readonly class DeleteFavoriteCommand
{
    /**
     * コンストラクタ
     *
     * @param array<int> $ids
     */
    public function __construct(
        public array $ids,
    ) {
    }
}
