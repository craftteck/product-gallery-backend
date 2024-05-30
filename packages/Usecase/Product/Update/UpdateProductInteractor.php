<?php

namespace Packages\Usecase\Product\Update;

use Packages\Domain\Product\Product;
use Packages\Domain\Product\ProductRepositoryInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

readonly final class UpdateProductInteractor implements UpdateProductInteractorInterface {
    public function __construct(
        private ProductRepositoryInterface $repository,
    ) {}

    public function execute(UpdateProductCommand $command): UpdateProductDto
    {
        $product = $this->repository->findById($command->id);

        if (is_null($product)) {
            throw new NotFoundHttpException('Target resource not found.');
        }

        $updated = $this->repository->update($this->toEntiry($command));
        return $this->toDto($updated);
    }

    private function toEntiry(UpdateProductCommand $command): Product {
        return new Product(
            id: $command->id,
            userId: $command->userId,
            name: $command->name,
            summary: $command->summary,
            description: $command->description,
            url: $command->url,
        );
    }

    private function toDto(Product $product): UpdateProductDto {
        return new UpdateProductDto(
            id: $product->id,
            userId: $product->userId,
            name: $product->name,
            summary: $product->summary,
            description: $product->description,
            url: $product->url,
        );
    }
}
