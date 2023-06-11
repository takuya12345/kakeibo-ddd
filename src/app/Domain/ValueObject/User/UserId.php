<?php

namespace App\Domain\ValueObject\User;

use Exception;

/**
 * ユーザーの名前用のValueObject
 */
final class UserId
{
    /**
     * ユーザーIDが不正な場合のエラーメッセージ
     */
    const MIN_VALUE = 1;
    const INVALID_MESSAGE = '不正な値です。';

    /**
     * @var int
     */
    private $value;

    /**
     * コンストラクタ
     *
     * @param int $value
     */
    public function __construct(int $value)
    {
        if ($this->isInvalid($value)) {
            throw new Exception(self::INVALID_MESSAGE);
        }
        $this->value = $value;
    }

    /**
     * @return int
     */
    public function value(): int
    {
        return $this->value;
    }

    /**
     * ユーザー名のバリデーション
     *
     * @param int $value
     * @return boolean
     */
    private function isInvalid(int $value): bool
    {
        return $value < self::MIN_VALUE;
    }
}