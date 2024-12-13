<?php

namespace Packages\UseCase\Product\Update;

use Packages\Domain\Product\Product;
use Packages\Domain\Product\ProductRepositoryInterface;
use Packages\UseCase\Product\Create\RegisterProductCommand;
use Packages\UseCase\Product\ProductDto;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * プロダクト更新のユースケースクラス
 */
readonly class UpdateProductUseCase
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
     * プロダクトを更新する
     *
     * @param RegisterProductCommand $command
     * @return ProductDto
     */
    public function execute(RegisterProductCommand $command): ProductDto
    {
        assert($command->id !== null);
        $product = $this->repository->findById($command->id);

        if (is_null($product)) {
            throw new NotFoundHttpException('Target resource not found.');
        }

        $updated = $this->repository->update($this->toEntity($command));
        return $this->toDto($updated);
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
            id: $command->id,
            userId: $command->userId,
            name: $command->name,
            summary: $command->summary,
            description: $command->description,
            url: $command->url,
            version: $command->version,
        );
    }

    /**
     * プロダクトをDTOに変換する
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
