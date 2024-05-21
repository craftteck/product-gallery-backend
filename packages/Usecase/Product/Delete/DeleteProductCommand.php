<?php

namespace Packages\Usecase\Product\Delete;

readonly final class DeleteProductCommand {
    public function __construct(
        public array $ids,
    ) {}
}
