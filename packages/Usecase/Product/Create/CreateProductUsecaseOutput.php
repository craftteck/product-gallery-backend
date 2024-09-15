<?php

namespace Packages\Usecase\Product\Create;

/**
 * プロダクト作成のDTOクラス
 */
final readonly class CreateProductUsecaseOutput
{
    /**
     * コンストラクタ
     *
     * @param int $id
     * @param int $userId
     * @param string $name
     * @param string $summary
     * @param string $description
     * @param string $url
     * @param int $version
     */
    public function __construct(
        public int $id,
        public int $userId,
        public string $name,
        public string $summary,
        public string $description,
        public string $url,
        public int $version,
    ) {
    }
}
