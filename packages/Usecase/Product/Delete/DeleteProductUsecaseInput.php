<?php

namespace Packages\Usecase\Product\Delete;

/**
 * プロダクト削除のユースケースインプット
 */
final readonly class DeleteProductUsecaseInput
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
