<?php

namespace Packages\Usecase\Favorite\Delete;

/**
 * お気に入り削除のユースケースインプット
 */
final readonly class DeleteFavoriteUsecaseInput
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
