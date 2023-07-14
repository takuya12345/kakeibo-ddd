<?php
namespace App\UseCase\CreateSpendings;

require_once __DIR__ . '/../../../vendor/autoload.php';

use App\Domain\ValueObject\User\UserName;
use App\Domain\ValueObject\User\UserId;
use App\Domain\ValueObject\User\SpendingsAmount;
use App\Domain\ValueObject\User\CategoryId;
use App\Domain\ValueObject\User\AccrualDate;

/**
 * ユースケースの入力値
 */
final class UseCaseInput
{
    /**
     * @var UserName
     */
    private $userName;

    /**
     * @var UserId
     */
    private $userId;

    /**
     * @var SpendingsAmount
     */
    private $spendingsAmount;

    /**
     * @var CategoryId
     */
    private $categoryId;

    /**
     * @var AccrualDate
     */
    private $accrualDate;

    /**
     * コンストラクタ
     *
     * @param UserName $userName
     * @param UserId $userId
     * @param SpendingsAmount $spendingsAmount
     * @param CategoryId $categoryId
     * @param AccurualDate $accrualDate
     */
    public function __construct(UserName $userName, UserId $userId, SpendingsAmount $spendingsAmount, CategoryId $categoryId, AccrualDate $accrualDate)
    {
        $this->userName = $userName;
        $this->userId = $userId;
        $this->spendingsAmount = $spendingsAmount;
        $this->categoryId = $categoryId;
        $this->accrualDate = $accrualDate;
    }

    /**
     * @return UserName
     */
    public function userName(): UserName
    {
        return $this->userName;
    }

    /**
     * @return UserId
     */
    public function userId(): UserId
    {
        return $this->userId;
    }
    /**
     * @return SpendingsAmount
     */
    public function spendingsAmount(): SpendingsAmount
    {
        return $this->spendingsAmount;
    }

    /**
     * @return CategoryId
     */
    public function categoryId(): CategoryId
    {
        return $this->categoryId;
    }
    
    /**
     * @return AccrualDate
     */
    public function accrualDate(): AccrualDate
    {
        return $this->accrualDate;
    }
}
