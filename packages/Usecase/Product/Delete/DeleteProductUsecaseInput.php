<?php

namespace Packages\Usecase\Product\Delete;

/**
 * プロダクト削除のコマンドクラス
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
