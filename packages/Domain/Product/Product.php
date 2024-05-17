<?php

namespace Packages\Domain\Product;

readonly final class Product {
    public function __construct(
        public ?int $id,
        public int $userId,
        public string $name,
        public string $summary,
        public string $description,
        public string $url,
    ) {}
}
