<?php

namespace Packages\Usecase\Product\Read;

use Packages\Domain\Product\Product;
use Packages\Domain\Product\ProductRepositoryInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * プロダクト取得のユースケースクラス
 */
final readonly class ReadProductUsecase implements ReadProductUsecaseInterface
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
     * @param ReadProductUsecaseInput $usecaseInput
     * @return ReadProductUsecaseOutput
     */
    public function execute(ReadProductUsecaseInput $usecaseInput): ReadProductUsecaseOutput
    {
        $product = $this->repository->findById($usecaseInput->id);

        if (is_null($product)) {
            throw new NotFoundHttpException('Target resource not found.');
        }

        return $this->toUsecaseOutput($product);
    }

    /**
     * エンティティをDTOに変換する
     *
     * @param Product $product
     * @return ReadProductUsecaseOutput
     */
    private function toUsecaseOutput(Product $product): ReadProductUsecaseOutput
    {
        /** @var int $productId */
        $productId = $product->id;
        /** @var int $version */
        $version = $product->version;

        return new ReadProductUsecaseOutput(
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
