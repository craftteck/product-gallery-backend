<?php

namespace Packages\Usecase\Product\Update;

use Packages\Domain\Product\Product;
use Packages\Domain\Product\ProductRepositoryInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * プロダクト更新のインタラクタークラス
 */
readonly final class UpdateProductUsecase implements UpdateProductUsecaseInterface {
    /**
     * コンストラクタ
     *
     * @param ProductRepositoryInterface $repository
     */
    public function __construct(
        private ProductRepositoryInterface $repository,
    ) {}

    /**
     * プロダクトを更新する
     *
     * @param UpdateProductUsecaseInput $usecaseInput
     * @return UpdateProductUsecaseOutput
     */
    public function execute(UpdateProductUsecaseInput $usecaseInput): UpdateProductUsecaseOutput
    {
        $product = $this->repository->findById($usecaseInput->id);

        if (is_null($product)) {
            throw new NotFoundHttpException('Target resource not found.');
        }

        $updated = $this->repository->update($this->toEntiry($usecaseInput));
        return $this->toUsecaseOutput($updated);
    }

    /**
     * コマンドをエンティティに変換する
     *
     * @param UpdateProductUsecaseInput $usecaseInput
     * @return Product
     */
    private function toEntiry(UpdateProductUsecaseInput $usecaseInput): Product {
        return new Product(
            id: $usecaseInput->id,
            userId: $usecaseInput->userId,
            name: $usecaseInput->name,
            summary: $usecaseInput->summary,
            description: $usecaseInput->description,
            url: $usecaseInput->url,
        );
    }

    /**
     * プロダクトをDTOに変換する
     *
     * @param Product $product
     * @return UpdateProductUsecaseOutput
     */
    private function toUsecaseOutput(Product $product): UpdateProductUsecaseOutput {
        /** @var int $productId */
        $productId = $product->id;

        return new UpdateProductUsecaseOutput(
            id: $productId,
            userId: $product->userId,
            name: $product->name,
            summary: $product->summary,
            description: $product->description,
            url: $product->url,
        );
    }
}
