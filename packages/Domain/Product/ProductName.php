<?php

namespace Packages\Domain\Product;

use InvalidArgumentException;

/** プロダクト名の値オブジェクト */
readonly class ProductName
{
    public const int MIN_LENGTH = 1;
    public const int MAX_LENGTH = 100;

    /**
     * コンストラクタ
     *
     * @param string $value
     */
    public function __construct(
        public string $value
    ) {
        if (!$this->isValid()) {
            throw new InvalidArgumentException();
        }
    }

    /**
     * バリデーション
     *
     * @return bool
     */
    private function isValid(): bool
    {
        $length = mb_strlen($this->value);
        return $length >= self::MIN_LENGTH && $length <= self::MAX_LENGTH;
    }

    /**
     * 値オブジェクト同士が等しいか判定
     *
     * @param ProductName $name
     * @return bool
     */
    public function equals(ProductName $name): bool
    {
        return $this->value === $name->value;
    }
}
