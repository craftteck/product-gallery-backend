<?php

namespace Packages\Domain\Product;

interface ProductRepositoryInterface {
    /**
     * プロダクトを登録する
     */
    public function insert(Product $product): Product;
}
