<?php

namespace Packages\Domain\Product;

/**
 * プロダクトのリポジトリインターフェース
 */
interface ProductRepositoryInterface
{
    /**
     * プロダクトを取得する
     *
     * @param int $id
     * @return ?Product
     */
    public function findById(int $id): ?Product;

    /**
     * プロダクトを登録する
     *
     * @param Product $product
     * @return Product
     */
    public function insert(Product $product): Product;

    /**
     * プロダクトを更新する
     *
     * @param Product $product
     * @return Product
     */
    public function update(Product $product): Product;

    /**
     * プロダクトを削除する
     *
     * @param array<int> $ids
     */
    public function delete(array $ids): void;
}
