<?php

namespace Packages\Domain\Favorite;

/**
 * お気に入り
 */
final readonly class Favorite
{
    /**
     * @param ?int $id
     * @param int $userId
     * @param int $productId
     * @param ?int $version
     */
    public function __construct(
        public ?int $id,
        public int $userId,
        public int $productId,
        public ?int $version,
    ) {
    }
}
