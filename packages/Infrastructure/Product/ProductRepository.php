<?php

namespace Packages\Infrastructure\Product;

use Packages\Domain\Product\Product;
use Packages\Domain\Product\ProductRepositoryInterface;
use App\Models\Product as Model;

readonly final class ProductRepository implements ProductRepositoryInterface {
    public function insert(Product $product): Product
    {
        $record = Model::create([
            'user_id' => $product->userId,
            'name' => $product->name,
            'summary' => $product->summary,
            'description' => $product->description,
            'url' => $product->url,
        ]);
        return $this->toEntity($record);
    }

    private function toEntity(object $record): Product {
        return new Product(
            id: $record->id,
            userId: $record->id,
            name: $record->id,
            summary: $record->id,
            description: $record->id,
            url: $record->id,
        );
    }
}
