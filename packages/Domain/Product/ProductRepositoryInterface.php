<?php

namespace Packages\Domain\Product;

interface ProductRepositoryInterface {
    /**
     * IDに該当するプロダクトを取得する
     */
    public function findById(int $id): ?Product;

    /**
     * プロダクトを登録する
     */
    public function insert(Product $product): Product;
}
