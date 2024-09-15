<?php

namespace Packages\Usecase\Product\Create;

/**
 * プロダクト作成のインタラクターインターフェース
 */
interface CreateProductUsecaseInterface
{
    public function execute(CreateProductUsecaseInput $usecaseInput): CreateProductUsecaseOutput;
}
