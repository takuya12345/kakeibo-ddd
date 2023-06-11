<?php

namespace App\Domain\ValueObject\User;

use Exception;

/**
 * ユーザーの名前用のValueObject
 */
final class CategoryId
{
    /**
     * カテゴリーIDが不正な場合のエラーメッセージ
     */
    const INVALID_MESSAGE = '不正な値です。';

    /**
     * @var string
     */
    private $value;

    /**
     * コンストラクタ
     *
     * @param string $value
     */
    public function __construct(string $value)
    {
        if ($this->isInvalid($value)) {
            throw new \Exception(self::INVALID_MESSAGE);
        }

        $this->value = $value;
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->value;
    }

    /**
     * ユーザー名のバリデーション
     *
     * @param string $value
     * @return boolean
     */
    private function isInvalid(string $value): bool
    {
        return mb_strlen($value) > 20;
    }
}