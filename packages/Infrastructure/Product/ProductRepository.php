<?php

namespace Packages\Infrastructure\Product;

use Packages\Domain\Product\Product;
use Packages\Domain\Product\ProductRepositoryInterface;
use App\Models\Product as Model;

readonly final class ProductRepository implements ProductRepositoryInterface {
    public function findById(int $id): ?Product
    {
        $record = Model::find($id);
        return $record ? $this->toEntity($record) : null;
    }

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

    // TODO: 自身のユーザーIDを持つプロダクト以外は更新不可にする仕組みを検討
    // TODO: 楽観ロックの仕組みを追加
    public function update(Product $product): Product
    {
        Model::find($product->id)->update([
            'name' => $product->name,
            'summary' => $product->summary,
            'description' => $product->description,
            'url' => $product->url,
        ]);
        $updated = Model::find($product->id);
        return $this->toEntity($updated);
    }

    // TODO: 自身のユーザーIDを持つプロダクト以外は更新不可にする仕組みを検討
    public function delete(array $ids): void
    {
        Model::whereIn('id', $ids)->delete();
    }

    private function toEntity(object $record): Product {
        return new Product(
            id: $record->id,
            userId: $record->user_id,
            name: $record->name,
            summary: $record->summary,
            description: $record->description,
            url: $record->url,
        );
    }
}
