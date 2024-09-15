<?php

namespace Packages\Usecase\Product\Read;

/**
 * プロダクト取得のインタラクターインターフェース
 */
interface ReadProductUsecaseInterface {
    public function execute(ReadProductUsecaseInput $usecaseInput): ReadProductUsecaseOutput;
}
