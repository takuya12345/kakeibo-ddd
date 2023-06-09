<?php
namespace App\Dao;

require_once __DIR__ . '/../../vendor/autoload.php';

use PDO;

/**
 * 収入のDao
 */
final class IncomeDao
{
  /**
   * @var PDO
   */
  private $pdo;

  /**
   * コンストラクタ
   * 
   * @param PDO $pdo
   */
  public function __construct()
  {
    $this->pdo = new PDO("mysql:host=mysql; dbname=kakeibo; charset=utf8", "root", "password");
  }

  /**
   * @param int $userId
   * @param int $incomeSourced
   * @param int $amount
   * @param string $accrualDate
   * return void
   */
  public function createIncomeSource(int $incomeSourceId, int $amount, string $accrualDate): void
  {
    $userId = $_SESSION['user']['id'];
    $sql = 'INSERT INTO `incomes`(`id`, `user_id`, `income_source_id`, `amount`, `accrual_date`) VALUES(0, :userId, :incomeSourceId, :amount, :accrualDate)';
    $statement = $this->pdo->prepare($sql);
    $statement->bindValue(':userId', $userId, PDO::PARAM_INT);
    $statement->bindValue(':incomeSourceId', $incomeSourceId, PDO::PARAM_INT);
    $statement->bindValue(':amount', $amount, PDO::PARAM_INT);
    $statement->bindValue(':accrualDate', $accrualDate, PDO::PARAM_STR);
    $statement->execute();
  }
}