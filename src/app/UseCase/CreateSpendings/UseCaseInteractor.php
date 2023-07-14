<?php
namespace App\UseCase\CreateSpendings;

require_once __DIR__ . '/../../../vendor/autoload.php';

use App\Dao\SpendingDao;
use App\UseCase\CreateSpendings\UseCaseInput;
use App\UseCase\CreateSpendings\UseCaseOutput;

/**
 * ユースケースの入力値
 */
final class UseCaseInteractor
{
    /**
     * 登録失敗時のメッセージ
     */
    const FAILED_MESSAGE = "登録内容が間違っています。";

    /**
     * 登録成功時のメッセージ
     */
    const SUCCESS_MESSAGE = "登録しました。";
    
    /**
     * @var UseCaseInput
     */
    private $input;

    /**
     * @var SpendingDao
     */
    private $spendingDao;

    /**
     * コンストラクタ
     *
     * @param UseCaseInput $input
     * @param SpendingDao $spendingDao
     */
    public function __construct(UseCaseInput $input, SpendingDao $spendingDao)
    {
        $this->input = $input;
        $this->spendingDao = $spendingDao;
    }

    /**
     * ユーザー登録処理
     * すでに存在するメールアドレスの場合はエラーとする
     *
     * @return UseCaseOutput
     */
    public function handler(): UseCaseOutput
    {
        session_start();
        $loginUserId = $_SESSION['user']['id'];
        $registerUserId = $this->input->userId()->value();

        if ($this->isCorrectUserId($loginUserId, $registerUserId)) {
            return new UseCaseOutput(false, self::FAILED_MESSAGE);
        }

        $this->spendingDao->createSpendingSource($this->input->userName()->value(), $this->input->userId()->value(), $this->input->categoryId()->value(), $this->input->spendingsAmount()->value(), $this->input->accrualDate()->value());
        return new UseCaseOutput(true, self::SUCCESS_MESSAGE);
    }

    /**
     * ユーザーが存在するかどうか
     *
     * @param array|null $user
     * @return boolean
     */
    private function isCorrectUserId(int $loginUserId, int $registerUserId): bool
    {
        return $loginUserId !== $registerUserId;
    }

}