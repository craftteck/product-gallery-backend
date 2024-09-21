<?php

namespace Packages\Usecase\Product\Delete;

/**
 * プロダクト削除のユースケースインターフェース
 */
interface DeleteProductUsecaseInterface
{
    public function execute(DeleteProductUsecaseInput $usecaseInput): void;
}
