<?php

namespace Packages\UseCase\Product\Read;

use Packages\Domain\Product\Product;
use Packages\Domain\Product\ProductRepositoryInterface;
use Packages\UseCase\Product\ProductDto;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * プロダクト取得のユースケースクラス
 */
readonly class ReadProductUseCase
{
    /**
     * @param ProductRepositoryInterface $repository
     */
    public function __construct(
        private ProductRepositoryInterface $repository,
    ) {
    }

    /**
     * プロダクトを取得する
     *
     * @param ReadProductCommand $command
     * @return ProductDto
     */
    public function execute(ReadProductCommand $command): ProductDto
    {
        $product = $this->repository->findById($command->id);

        if (is_null($product)) {
            throw new NotFoundHttpException('Target resource not found.');
        }

        return $this->toDto($product);
    }

    /**
     * エンティティをDTOに変換する
     *
     * @param Product $product
     * @return ProductDto
     */
    private function toDto(Product $product): ProductDto
    {
        /** @var int $productId */
        $productId = $product->id;
        /** @var int $version */
        $version = $product->version;

        return new ProductDto(
            id: $productId,
            userId: $product->userId,
            name: $product->name,
            summary: $product->summary,
            description: $product->description,
            url: $product->url,
            version: $version,
        );
    }
}
