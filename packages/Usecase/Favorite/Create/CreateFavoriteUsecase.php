<?php

namespace Packages\Usecase\Favorite\Create;

use Packages\Domain\Favorite\Favorite;
use Packages\Domain\Favorite\FavoriteRepositoryInterface;

/**
 * お気に入り登録のユースケースクラス
 */
final readonly class CreateFavoriteUsecase implements CreateFavoriteUsecaseInterface
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
     * @param CreateFavoriteUsecaseInput $usecaseInput
     * @return CreateFavoriteUsecaseOutput
     */
    public function execute(CreateFavoriteUsecaseInput $usecaseInput): CreateFavoriteUsecaseOutput
    {
        $product = $this->repository->insert($this->toEntiry($usecaseInput));
        return $this->toUsecaseOutput($product);
    }

    /**
     * ユースケースインプットをエンティティに変換する
     *
     * @param CreateFavoriteUsecaseInput $usecaseInput
     * @return Favorite
     */
    private function toEntiry(CreateFavoriteUsecaseInput $usecaseInput): Favorite
    {
        return new Favorite(
            id: null,
            userId: $usecaseInput->userId,
            productId: $usecaseInput->productId,
            version: null,
        );
    }

    /**
     * エンティティをDTOに変換する
     *
     * @param Favorite $favorite
     * @return CreateFavoriteUsecaseOutput
     */
    private function toUsecaseOutput(Favorite $favorite): CreateFavoriteUsecaseOutput
    {
        /** @var int $favoriteId */
        $favoriteId = $favorite->id;
        /** @var int $version */
        $version = $favorite->version;

        return new CreateFavoriteUsecaseOutput(
            id: $favoriteId,
            userId: $favorite->userId,
            productId: $favorite->userId,
            version: $version,
        );
    }
}
