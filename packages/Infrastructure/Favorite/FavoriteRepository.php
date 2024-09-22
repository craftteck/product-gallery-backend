<?php

namespace Packages\Infrastructure\Favorite;

use App\Models\Favorite;
use Packages\Domain\Favorite\Favorite as FavoriteEntity;
use Packages\Domain\Favorite\FavoriteRepositoryInterface;

/**
 * お気に入りのリポジトリクラス
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
     * お気に入りを削除する
     * TODO: 自身のユーザーIDを持つお気に入り以外は更新不可にする仕組みを検討
     *
     * @param array<int> $ids
     */
    public function delete(array $ids): void
    {
        Favorite::whereIn('id', $ids)->delete();
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
