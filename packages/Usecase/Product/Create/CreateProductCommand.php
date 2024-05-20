<?php

namespace Packages\Usecase\Product\Create;

readonly final class CreateProductCommand {
    public function __construct(
        public int $userId,
        public string $name,
        public string $summary,
        public string $description,
        public string $url,
    ) {}
}
