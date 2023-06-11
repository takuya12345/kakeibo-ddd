<?php

namespace App\Domain\ValueObject\User;

use Exception;
/**
 * ユーザーの名前用のValueObject
 */
final class AccrualDate
{
    /**
     * ユーザーの名前が不正な場合のエラーメッセージ
     */
    const INVALID_MESSAGE = '日付を正しく入力してください。';

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
     * バリデーションを通った値を返す
     * 
     * @return string
     */
    public function value() :string
    {
        return $this->value;
    }

    /**
     * ユーザー名のバリデーション
     *
     * @param string $value
     * @return bool
     */
    private function isInvalid(string $value): bool
    {
        // ここのバリデーションが分からない
        return mb_strlen($value) > 20;
    }
}