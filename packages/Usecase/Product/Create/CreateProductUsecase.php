<?php

namespace Packages\Usecase\Product\Create;

use Packages\Domain\Product\Product;
use Packages\Domain\Product\ProductRepositoryInterface;

/**
 * プロダクト作成のユースケースクラス
 */
final readonly class CreateProductUsecase implements CreateProductUsecaseInterface
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
     * @param CreateProductUsecaseInput $usecaseInput
     * @return CreateProductUsecaseOutput
     */
    public function execute(CreateProductUsecaseInput $usecaseInput): CreateProductUsecaseOutput
    {
        $product = $this->repository->insert($this->toEntiry($usecaseInput));
        return $this->toUsecaseOutput($product);
    }

    /**
     * ユースケースインプットをエンティティに変換する
     *
     * @param CreateProductUsecaseInput $usecaseInput
     * @return Product
     */
    private function toEntiry(CreateProductUsecaseInput $usecaseInput): Product
    {
        return new Product(
            id: null,
            userId: $usecaseInput->userId,
            name: $usecaseInput->name,
            summary: $usecaseInput->summary,
            description: $usecaseInput->description,
            url: $usecaseInput->url,
            version: null,
        );
    }

    /**
     * エンティティをDTOに変換する
     *
     * @param Product $product
     * @return CreateProductUsecaseOutput
     */
    private function toUsecaseOutput(Product $product): CreateProductUsecaseOutput
    {
        /** @var int $productId */
        $productId = $product->id;
        /** @var int $version */
        $version = $product->version;

        return new CreateProductUsecaseOutput(
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
