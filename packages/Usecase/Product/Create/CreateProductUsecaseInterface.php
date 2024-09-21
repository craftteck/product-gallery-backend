<?php

namespace Packages\Usecase\Product\Create;

/**
 * プロダクト作成のユースケースインターフェース
 */
interface CreateProductUsecaseInterface
{
    public function execute(CreateProductUsecaseInput $usecaseInput): CreateProductUsecaseOutput;
}
