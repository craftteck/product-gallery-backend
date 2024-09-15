<?php

namespace Packages\Usecase\Product\Read;

/**
 * プロダクト取得のコマンドクラス
 */
readonly final class ReadProductUsecaseInput {
    /**
     * コンストラクタ
     *
     * @param int $id
     */
    public function __construct(
        public int $id,
    ) {}
}
