<?php

namespace Packages\Usecase\Product\Create;

interface CreateProductInteractorInterface {
    public function execute(CreateProductCommand $command): CreateProductDto;
}
