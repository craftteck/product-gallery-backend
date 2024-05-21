<?php

namespace Packages\Usecase\Product\Delete;

use Packages\Domain\Product\ProductRepositoryInterface;

readonly final class DeleteProductInteractor implements DeleteProductInteractorInterface {
    public function __construct(
        private ProductRepositoryInterface $repository,
    ) {}

    public function execute(DeleteProductCommand $command): void
    {
        $this->repository->delete($command->ids);
    }
}
