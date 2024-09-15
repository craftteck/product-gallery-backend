<?php

namespace Packages\Usecase\Product\Delete;

/**
 * プロダクト削除のコマンドクラス
 */
readonly final class DeleteProductUsecaseInput {
    /**
     * コンストラクタ
     *
     * @param array<int> $ids
     */
    public function __construct(
        public array $ids,
    ) {}
}
