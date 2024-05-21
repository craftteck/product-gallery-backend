<?php

namespace Packages\Domain\Product;

use Illuminate\Database\Eloquent\Collection;

interface ProductRepositoryInterface {
    /**
     * IDに該当するプロダクトを取得する
     */
    public function findById(int $id): ?Product;

    /**
     * プロダクトを登録する
     */
    public function insert(Product $product): Product;

    /**
     * プロダクトを削除する
     */
    public function delete(array $ids): void;
}
