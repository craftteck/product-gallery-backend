<?php

namespace Packages\Usecase\Product\Create;

use Packages\Domain\Product\Product;
use Packages\Domain\Product\ProductRepositoryInterface;

readonly final class CreateProductInteractor implements CreateProductInteractorInterface {
    public function __construct(
        private ProductRepositoryInterface $repository,
    ) {}

    public function execute(CreateProductCommand $command): CreateProductDto
    {
        $product = $this->repository->insert($this->toEntiry($command));
        return $this->toDto($product);
    }

    private function toEntiry(CreateProductCommand $command): Product {
        return new Product(
            id: null,
            userId: $command->userId,
            name: $command->name,
            summary: $command->summary,
            description: $command->description,
            url: $command->url,
        );        
    }

    private function toDto(Product $product): CreateProductDto {
        return new CreateProductDto(
            id: $product->id,
            userId: $product->userId,
            name: $product->name,
            summary: $product->summary,
            description: $product->description,
            url: $product->url,
        );
    }
}
