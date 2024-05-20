<?php

namespace Packages\Usecase\Product\Read;

use Packages\Domain\Product\Product;
use Packages\Domain\Product\ProductRepositoryInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

readonly final class ReadProductInteractor implements ReadProductInteractorInterface {
    public function __construct(
        private ProductRepositoryInterface $repository,
    ) {}

    public function execute(ReadProductCommand $command): ReadProductDto
    {
        $product = $this->repository->findById($command->id);

        if (is_null($product)) {
            throw new NotFoundHttpException('Target resource not found.');
        }

        return $this->toDto($product);
    }

    private function toDto(Product $product): ReadProductDto {
        return new ReadProductDto(
            id: $product->id,
            userId: $product->userId,
            name: $product->name,
            summary: $product->summary,
            description: $product->description,
            url: $product->url,
        );
    }
}
