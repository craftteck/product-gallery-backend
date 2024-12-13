<?php

namespace Packages\UseCase\Product\Delete;

use Packages\Domain\Product\ProductRepositoryInterface;

/**
 * プロダクト削除のユースケースクラス
 */
readonly class DeleteProductUseCase
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
     * @param DeleteProductCommand $command
     */
    public function execute(DeleteProductCommand $command): void
    {
        $this->repository->delete($command->ids);
    }
}
