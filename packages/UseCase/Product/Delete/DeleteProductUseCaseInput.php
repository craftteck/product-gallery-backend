<?php

namespace Packages\UseCase\Product\Delete;

/**
 * プロダクト削除のユースケースインプット
 */
final readonly class DeleteProductUseCaseInput
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
