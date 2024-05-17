<?php

namespace Packages\Usecase\Product;

readonly final class CreateProductCommand {
    public function __construct(
        public string $name,
        public string $summary,
        public string $description,
        public string $url,
    ) {}
}
