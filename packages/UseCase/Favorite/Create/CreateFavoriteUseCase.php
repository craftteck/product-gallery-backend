<?php

namespace Packages\UseCase\Favorite\Create;

use Packages\Domain\Favorite\Favorite;
use Packages\Domain\Favorite\FavoriteRepositoryInterface;
use Packages\UseCase\Favorite\FavoriteDto;

/**
 * お気に入り登録のユースケースクラス
 */
readonly class CreateFavoriteUseCase
{
    /**
     * コンストラクタ
     *
     * @param FavoriteRepositoryInterface $repository
     */
    public function __construct(
        private FavoriteRepositoryInterface $repository,
    ) {
    }

    /**
     * お気に入りを登録する
     *
     * @param RegisterFavoriteCommand $command
     * @return FavoriteDto
     */
    public function execute(RegisterFavoriteCommand $command): FavoriteDto
    {
        $product = $this->repository->insert($this->toEntity($command));
        return $this->toDto($product);
    }

    /**
     * コマンドをエンティティに変換する
     *
     * @param RegisterFavoriteCommand $command
     * @return Favorite
     */
    private function toEntity(RegisterFavoriteCommand $command): Favorite
    {
        return new Favorite(
            id: null,
            userId: $command->userId,
            productId: $command->productId,
            version: null,
        );
    }

    /**
     * エンティティをDTOに変換する
     *
     * @param Favorite $favorite
     * @return FavoriteDto
     */
    private function toDto(Favorite $favorite): FavoriteDto
    {
        /** @var int $favoriteId */
        $favoriteId = $favorite->id;
        /** @var int $version */
        $version = $favorite->version;

        return new FavoriteDto(
            id: $favoriteId,
            userId: $favorite->userId,
            productId: $favorite->productId,
            version: $version,
        );
    }
}
