<?php

namespace Packages\UseCase\Product\Read;

/**
 * プロダクト取得のユースケースインターフェース
 */
interface ReadProductUseCaseInterface
{
    public function execute(ReadProductUseCaseInput $useCaseInput): ReadProductUseCaseOutput;
}
