<?php

namespace Packages\UseCase\Product\Read;

/**
 * プロダクト取得のユースケースインプット
 */
final readonly class ReadProductUseCaseInput
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
