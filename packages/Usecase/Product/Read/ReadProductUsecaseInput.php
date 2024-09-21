<?php

namespace Packages\Usecase\Product\Read;

/**
 * プロダクト取得のユースケースインプット
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
