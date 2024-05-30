<?php

namespace Packages\Usecase\Product\Update;

readonly final class UpdateProductDto {
    public function __construct(
        public int $id,
        public int $userId,
        public string $name,
        public string $summary,
        public string $description,
        public string $url,
    ) {}
}
