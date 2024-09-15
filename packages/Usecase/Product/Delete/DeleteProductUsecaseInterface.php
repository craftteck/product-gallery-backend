<?php

namespace Packages\Usecase\Product\Delete;

/**
 * プロダクト削除のインタラクターインターフェース
 */
interface DeleteProductUsecaseInterface
{
    public function execute(DeleteProductUsecaseInput $usecaseInput): void;
}
