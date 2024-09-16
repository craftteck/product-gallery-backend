<?php

namespace Packages\Usecase\Product\Read;

/**
 * プロダクト取得のコマンドクラス
 */
final readonly class ReadProductUsecaseInput
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