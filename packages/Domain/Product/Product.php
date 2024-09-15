<?php

namespace Packages\Domain\Product;

/**
 * プロダクト
 */
final readonly class Product
{
    /**
     * @param ?int $id
     * @param int $userId
     * @param string $name
     * @param string $summary
     * @param string $description
     * @param string $url
     */
    public function __construct(
        public ?int $id,
        public int $userId,
        public string $name,
        public string $summary,
        public string $description,
        public string $url,
    ) {
    }
}
