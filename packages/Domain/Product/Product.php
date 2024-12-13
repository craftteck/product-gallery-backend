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
     * @param ProductName $name
     * @param string $summary
     * @param string $description
     * @param string $url
     * @param ?int $version
     */
    public function __construct(
        public ?int $id,
        public int $userId,
        public ProductName $name,
        public string $summary,
        public string $description,
        public string $url,
        public ?int $version,
    ) {
    }
}
