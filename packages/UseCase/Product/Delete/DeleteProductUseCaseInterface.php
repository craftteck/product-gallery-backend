<?php

namespace Packages\UseCase\Product\Delete;

/**
 * プロダクト削除のユースケースインターフェース
 */
interface DeleteProductUseCaseInterface
{
    public function execute(DeleteProductUseCaseInput $useCaseInput): void;
}
