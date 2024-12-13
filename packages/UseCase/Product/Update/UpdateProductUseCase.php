<?php

namespace Packages\UseCase\Product\Update;

use Packages\Domain\Product\Product;
use Packages\Domain\Product\ProductRepositoryInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * プロダクト更新のユースケースクラス
 */
final readonly class UpdateProductUseCase implements UpdateProductUseCaseInterface
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
     * @param UpdateProductUseCaseInput $useCaseInput
     * @return UpdateProductUseCaseOutput
     */
    public function execute(UpdateProductUseCaseInput $useCaseInput): UpdateProductUseCaseOutput
    {
        $product = $this->repository->findById($useCaseInput->id);

        if (is_null($product)) {
            throw new NotFoundHttpException('Target resource not found.');
        }

        $updated = $this->repository->update($this->toEntity($useCaseInput));
        return $this->toUseCaseOutput($updated);
    }

    /**
     * コマンドをエンティティに変換する
     *
     * @param UpdateProductUseCaseInput $useCaseInput
     * @return Product
     */
    private function toEntity(UpdateProductUseCaseInput $useCaseInput): Product
    {
        return new Product(
            id: $useCaseInput->id,
            userId: $useCaseInput->userId,
            name: $useCaseInput->name,
            summary: $useCaseInput->summary,
            description: $useCaseInput->description,
            url: $useCaseInput->url,
            version: $useCaseInput->version,
        );
    }

    /**
     * プロダクトをDTOに変換する
     *
     * @param Product $product
     * @return UpdateProductUseCaseOutput
     */
    private function toUseCaseOutput(Product $product): UpdateProductUseCaseOutput
    {
        /** @var int $productId */
        $productId = $product->id;
        /** @var int $version */
        $version = $product->version;

        return new UpdateProductUseCaseOutput(
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
