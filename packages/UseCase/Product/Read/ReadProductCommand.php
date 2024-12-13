<?php

namespace Packages\UseCase\Product\Read;

/**
 * プロダクト取得のコマンド
 */
final readonly class ReadProductCommand
{
    /**
     * コンストラクタ
     *
     * @param int $id
     */
    public function __construct(
        public int $id,
    ) {
    }
}
