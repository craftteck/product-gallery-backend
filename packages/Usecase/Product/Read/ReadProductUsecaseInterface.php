<?php

namespace Packages\Usecase\Product\Read;

/**
 * プロダクト取得のユースケースインターフェース
 */
interface ReadProductUsecaseInterface
{
    public function execute(ReadProductUsecaseInput $usecaseInput): ReadProductUsecaseOutput;
}
