<?php

namespace Packages\Usecase\Product\Read;

readonly final class ReadProductCommand {
    public function __construct(
        public int $id,
    ) {}
}
