<?php

namespace App\Domain\ValueObject\User;

use Exception;
/**
 * ユーザーの名前用のValueObject
 */
final class SpendingsAmount
{
    /**
     * ユーザーの名前が不正な場合のエラーメッセージ
     */
    const INVALID_MESSAGE = '1円以上の金額を入力してください。';

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
            throw new Exception(self::INVALID_MESSAGE);
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
        return $value < 1;
    }
}