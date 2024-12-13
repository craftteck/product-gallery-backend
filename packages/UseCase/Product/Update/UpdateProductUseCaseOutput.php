<?php

namespace Packages\UseCase\Product\Update;

/**
 * プロダクト更新のDTO
 */
final readonly class UpdateProductUseCaseOutput
{
    /**
     * @param int $id
     * @param int $userId
     * @param string $name
     * @param string $summary
     * @param string $description
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
