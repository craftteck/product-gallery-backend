<?php

namespace Packages\Usecase\Product\Delete;

use Packages\Domain\Product\ProductRepositoryInterface;

/**
 * プロダクト削除のユースケースクラス
 */
final readonly class DeleteProductUsecase implements DeleteProductUsecaseInterface
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
     * @param DeleteProductUsecaseInput $usecaseInput
     */
    public function execute(DeleteProductUsecaseInput $usecaseInput): void
    {
        $this->repository->delete($usecaseInput->ids);
    }
}
