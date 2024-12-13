<?php

namespace Packages\UseCase\Favorite\Create;

use Packages\Domain\Favorite\Favorite;
use Packages\Domain\Favorite\FavoriteRepositoryInterface;

/**
 * お気に入り登録のユースケースクラス
 */
final readonly class CreateFavoriteUseCase implements CreateFavoriteUseCaseInterface
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
     * @param CreateFavoriteUseCaseInput $useCaseInput
     * @return CreateFavoriteUseCaseOutput
     */
    public function execute(CreateFavoriteUseCaseInput $useCaseInput): CreateFavoriteUseCaseOutput
    {
        $product = $this->repository->insert($this->toEntity($useCaseInput));
        return $this->toUseCaseOutput($product);
    }

    /**
     * ユースケースインプットをエンティティに変換する
     *
     * @param CreateFavoriteUseCaseInput $useCaseInput
     * @return Favorite
     */
    private function toEntity(CreateFavoriteUseCaseInput $useCaseInput): Favorite
    {
        return new Favorite(
            id: null,
            userId: $useCaseInput->userId,
            productId: $useCaseInput->productId,
            version: null,
        );
    }

    /**
     * エンティティをDTOに変換する
     *
     * @param Favorite $favorite
     * @return CreateFavoriteUseCaseOutput
     */
    private function toUseCaseOutput(Favorite $favorite): CreateFavoriteUseCaseOutput
    {
        /** @var int $favoriteId */
        $favoriteId = $favorite->id;
        /** @var int $version */
        $version = $favorite->version;

        return new CreateFavoriteUseCaseOutput(
            id: $favoriteId,
            userId: $favorite->userId,
            productId: $favorite->productId,
            version: $version,
        );
    }
}
