<?php

namespace Packages\UseCase\Product\Create;

/**
 * プロダクト作成のユースケースインターフェース
 */
interface CreateProductUseCaseInterface
{
    public function execute(CreateProductUseCaseInput $useCaseInput): CreateProductUseCaseOutput;
}
