<?php

namespace Packages\UseCase\Product\Delete;

/**
 * プロダクト削除のコマンド
 */
final readonly class DeleteProductCommand
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
