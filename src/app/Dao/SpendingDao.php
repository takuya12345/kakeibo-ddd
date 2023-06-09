<?php
namespace App\Dao;

require_once __DIR__ . '/../../vendor/autoload.php';

use PDO;

/**
 * 支出のDao
 */
final class SpendingDao
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
   * @param string $name
   * @param int $userId
   * @param int $categoryId
   * @param int $amount
   * @param string $accrualDate
   * return void
   */
  public function createSpendingSource(string $name, int $userId, int $categoryId, int $amount, string $accrualDate): void
  {
    $sql = 'INSERT INTO `spendings`(`id`, `name`, `user_id`, `category_id`, `amount`, `accrual_date`) VALUES(0, :name, :userId, :categoryId, :amount, :accrualDate)';
    $statement = $this->pdo->prepare($sql);
    $statement->bindValue(':name', $name, PDO::PARAM_STR);
    $statement->bindValue(':userId', $userId, PDO::PARAM_INT);
    $statement->bindValue(':categoryId', $categoryId, PDO::PARAM_INT);
    $statement->bindValue(':amount', $amount, PDO::PARAM_INT);
    $statement->bindValue(':accrualDate', $accrualDate, PDO::PARAM_STR);
    $statement->execute();
  }
}