<?php

namespace Packages\Usecase\Product\Create;

/**
 * プロダクト作成のコマンドクラス
 */
readonly final class CreateProductUsecaseInput {
    /**
     * コンストラクタ
     *
     * @param int $userId
     * @param string $name
     * @param string $summary
     * @param string $description
     * @param string $url
     */
    public function __construct(
        public int $userId,
        public string $name,
        public string $summary,
        public string $description,
        public string $url,
    ) {}
}
