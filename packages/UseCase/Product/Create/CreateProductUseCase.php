<?php

namespace Packages\UseCase\Product\Create;

use Packages\Domain\Product\Product;
use Packages\Domain\Product\ProductRepositoryInterface;

/**
 * プロダクト作成のユースケースクラス
 */
final readonly class CreateProductUseCase implements CreateProductUseCaseInterface
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
     * @param CreateProductUseCaseInput $useCaseInput
     * @return CreateProductUseCaseOutput
     */
    public function execute(CreateProductUseCaseInput $useCaseInput): CreateProductUseCaseOutput
    {
        $product = $this->repository->insert($this->toEntity($useCaseInput));
        return $this->toUseCaseOutput($product);
    }

    /**
     * ユースケースインプットをエンティティに変換する
     *
     * @param CreateProductUseCaseInput $useCaseInput
     * @return Product
     */
    private function toEntity(CreateProductUseCaseInput $useCaseInput): Product
    {
        return new Product(
            id: null,
            userId: $useCaseInput->userId,
            name: $useCaseInput->name,
            summary: $useCaseInput->summary,
            description: $useCaseInput->description,
            url: $useCaseInput->url,
            version: null,
        );
    }

    /**
     * エンティティをDTOに変換する
     *
     * @param Product $product
     * @return CreateProductUseCaseOutput
     */
    private function toUseCaseOutput(Product $product): CreateProductUseCaseOutput
    {
        /** @var int $productId */
        $productId = $product->id;
        /** @var int $version */
        $version = $product->version;

        return new CreateProductUseCaseOutput(
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
