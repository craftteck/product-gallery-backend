<?php

namespace Packages\UseCase\Product\Update;

/**
 * プロダクト更新のユースケースインターフェース
 */
interface UpdateProductUseCaseInterface
{
    public function execute(UpdateProductUseCaseInput $useCaseInput): UpdateProductUseCaseOutput;
}
