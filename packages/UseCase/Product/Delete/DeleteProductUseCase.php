<?php

namespace Packages\UseCase\Product\Delete;

use Packages\Domain\Product\ProductRepositoryInterface;

/**
 * プロダクト削除のユースケースクラス
 */
final readonly class DeleteProductUseCase implements DeleteProductUseCaseInterface
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
     * プロダクトを削除する
     *
     * @param DeleteProductUseCaseInput $useCaseInput
     */
    public function execute(DeleteProductUseCaseInput $useCaseInput): void
    {
        $this->repository->delete($useCaseInput->ids);
    }
}
