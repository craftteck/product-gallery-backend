<?php

namespace Packages\Usecase\Product;

interface CreateProductInteractorInterface {
    public function execute(CreateProductCommand $command): CreateProductDto;
}
