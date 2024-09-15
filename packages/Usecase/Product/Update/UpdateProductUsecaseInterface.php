<?php

namespace Packages\Usecase\Product\Update;

/**
 * プロダクト更新のインタラクターインターフェース
 */
interface UpdateProductUsecaseInterface
{
    public function execute(UpdateProductUsecaseInput $usecaseInput): UpdateProductUsecaseOutput;
}
