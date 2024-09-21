<?php

namespace Packages\Domain\Favorite;

/**
 * お気に入りのリポジトリインターフェース
 */
interface FavoriteRepositoryInterface
{
    /**
     * お気に入りを登録する
     *
     * @param Favorite $favorite
     * @return Favorite
     */
    public function insert(Favorite $favorite): Favorite;
}
