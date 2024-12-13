<?php

namespace Packages\UseCase\Product\Create;

use Packages\Domain\Product\Product;
use Packages\Domain\Product\ProductName;
use Packages\Domain\Product\ProductRepositoryInterface;
use Packages\UseCase\Product\ProductDto;

/**
 * プロダクト作成のユースケースクラス
 */
readonly class CreateProductUseCase
{
    /**
     * コンストラクタ
     *
     * @param ProductRepositoryInterface $repository
     */
    public function __construct(
        private ProductRepositoryInterface $repository,
    ) {
    }

    /**
     * プロダクトを作成する
     *
     * @param RegisterProductCommand $command
     * @return ProductDto
     */
    public function execute(RegisterProductCommand $command): ProductDto
    {
        $product = $this->repository->insert($this->toEntity($command));
        return $this->toDto($product);
    }

    /**
     * コマンドをエンティティに変換する
     *
     * @param RegisterProductCommand $command
     * @return Product
     */
    private function toEntity(RegisterProductCommand $command): Product
    {
        return new Product(
            id: null,
            userId: $command->userId,
            name: $command->name,
            summary: $command->summary,
            description: $command->description,
            url: $command->url,
            version: null,
        );
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
