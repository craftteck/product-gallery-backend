<?php

namespace Packages\Infrastructure\Product;

use App\Exceptions\OptimisticLockException;
use App\Models\Product;
use Packages\Domain\Product\Product as ProductEntity;
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
     * @return ?ProductEntity
     */
    public function findById(int $id): ?ProductEntity
    {
        $record = Product::find($id);
        return $record ? $this->toEntity($record) : null;
    }

    /**
     * プロダクトを登録する
     *
     * @param ProductEntity $product
     * @return ProductEntity
     */
    public function insert(ProductEntity $product): ProductEntity
    {
        $record = Product::create([
            'user_id' => $product->userId,
            'name' => $product->name,
            'summary' => $product->summary,
            'description' => $product->description,
            'url' => $product->url,
            'version' => 1,
        ]);
        return $this->toEntity($record);
    }

    /**
     * プロダクトを更新する
     * TODO: 自身のユーザーIDを持つプロダクト以外は更新不可にする仕組みを検討
     * TODO: 楽観ロックの仕組みを追加
     *
     * @param ProductEntity $product
     * @return ProductEntity
     */
    public function update(ProductEntity $product): ProductEntity
    {
        /** @var Product $target */
        $target = Product::find($product->id);

        if ($target->version !== $product->version) {
            throw new OptimisticLockException();
        }

        $target->update([
            'name' => $product->name,
            'summary' => $product->summary,
            'description' => $product->description,
            'url' => $product->url,
            'version' => $product->version + 1,
        ]);

        /** @var Product $updated */
        $updated = Product::find($product->id);

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
        Product::whereIn('id', $ids)->delete();
    }

    /**
     * モデルオブジェクトをエンティティに変換する
     *
     * @param Product $record
     * @return ProductEntity
     */
    private function toEntity(Product $record): ProductEntity
    {
        return new ProductEntity(
            id: $record->id,
            userId: $record->user_id,
            name: $record->name,
            summary: $record->summary,
            description: $record->description,
            url: $record->url,
            version: $record->version,
        );
    }
}
