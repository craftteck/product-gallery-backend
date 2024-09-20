<?php

namespace Packages\Infrastructure\Product;

use App\Models\Favorite;
use Packages\Domain\Favorite\Favorite as FavoriteEntity;
use Packages\Domain\Product\FavoriteRepositoryInterface;

/**
 * プロダクトのリポジトリクラス
 */
final readonly class FavoriteRepository implements FavoriteRepositoryInterface
{
    /**
     * お気に入りを登録する
     *
     * @param FavoriteEntity $favorite
     * @return FavoriteEntity
     */
    public function insert(FavoriteEntity $favorite): FavoriteEntity
    {
        $record = Favorite::create([
            'user_id' => $favorite->userId,
            'product_id' => $favorite->productId,
            'version' => 1,
        ]);
        return $this->toEntity($record);
    }

    /**
     * モデルオブジェクトをエンティティに変換する
     *
     * @param Favorite $record
     * @return FavoriteEntity
     */
    private function toEntity(Favorite $record): FavoriteEntity
    {
        return new FavoriteEntity(
            id: $record->id,
            userId: $record->user_id,
            productId: $record->product_id,
            version: $record->version,
        );
    }
}
