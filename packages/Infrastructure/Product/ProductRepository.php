<?php

namespace Packages\Infrastructure\Product;

use App\Models\Product as Model;
use Packages\Domain\Product\Product;
use Packages\Domain\Product\ProductRepositoryInterface;

/**
 * プロダクトのリポジトリクラス
 */
final readonly class ProductRepository implements ProductRepositoryInterface
{
    /**
     * IDに該当するプロダクトを取得する
     *
     * @param int $id
     * @return ?Product
     */
    public function findById(int $id): ?Product
    {
        $record = Model::find($id);
        return $record ? $this->toEntity($record) : null;
    }

    /**
     * プロダクトを登録する
     *
     * @param Product $product
     * @return Product
     */
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


    /**
     * プロダクトを更新する
     * TODO: 自身のユーザーIDを持つプロダクト以外は更新不可にする仕組みを検討
     * TODO: 楽観ロックの仕組みを追加
     *
     * @param Product $product
     * @return Product
     */
    public function update(Product $product): Product
    {
        /** @var Model $target */
        $target = Model::find($product->id);

        $target->update([
            'name' => $product->name,
            'summary' => $product->summary,
            'description' => $product->description,
            'url' => $product->url,
        ]);

        /** @var Model $updated */
        $updated = Model::find($product->id);

        return $this->toEntity($updated);
    }

    /**
     * プロダクトを削除する
     * TODO: 自身のユーザーIDを持つプロダクト以外は更新不可にする仕組みを検討
     *
     * @param array<int> $ids
     */
    public function delete(array $ids): void
    {
        Model::whereIn('id', $ids)->delete();
    }

    /**
     * モデルオブジェクトをエンティティに変換する
     *
     * @param Model $record
     * @return Product
     */
    private function toEntity(Model $record): Product
    {
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
