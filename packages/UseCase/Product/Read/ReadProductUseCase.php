<?php

namespace Packages\UseCase\Product\Read;

use Packages\Domain\Product\Product;
use Packages\Domain\Product\ProductRepositoryInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * プロダクト取得のユースケースクラス
 */
final readonly class ReadProductUseCase implements ReadProductUseCaseInterface
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
     * @param ReadProductUseCaseInput $useCaseInput
     * @return ReadProductUseCaseOutput
     */
    public function execute(ReadProductUseCaseInput $useCaseInput): ReadProductUseCaseOutput
    {
        $product = $this->repository->findById($useCaseInput->id);

        if (is_null($product)) {
            throw new NotFoundHttpException('Target resource not found.');
        }

        return $this->toUseCaseOutput($product);
    }

    /**
     * エンティティをDTOに変換する
     *
     * @param Product $product
     * @return ReadProductUseCaseOutput
     */
    private function toUseCaseOutput(Product $product): ReadProductUseCaseOutput
    {
        /** @var int $productId */
        $productId = $product->id;
        /** @var int $version */
        $version = $product->version;

        return new ReadProductUseCaseOutput(
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
