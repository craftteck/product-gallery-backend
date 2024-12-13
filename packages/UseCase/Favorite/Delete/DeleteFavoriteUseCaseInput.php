<?php

namespace Packages\UseCase\Favorite\Delete;

/**
 * お気に入り削除のユースケースインプット
 */
final readonly class DeleteFavoriteUseCaseInput
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
