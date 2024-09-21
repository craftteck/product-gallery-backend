<?php

namespace Packages\Usecase\Product\Update;

/**
 * プロダクト更新のユースケースインターフェース
 */
interface UpdateProductUsecaseInterface
{
    public function execute(UpdateProductUsecaseInput $usecaseInput): UpdateProductUsecaseOutput;
}
