<?php
namespace App\Dao;

require_once __DIR__ . '/../../vendor/autoload.php';

use PDO;

/**
 * ユーザーテーブル用のDao
 */
final class UserDao
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
     * @return array $user
     */
    public function fetchUserByEmail(string $email): ?array
    {
      $sql = 'SELECT * FROM users WHERE email = :email';
      $statement = $this->pdo->prepare($sql);
      $statement->bindValue(':email', $email, PDO::PARAM_STR);
      $statement->execute();
      $user = $statement->fetch(PDO::FETCH_ASSOC);

      return $user ? $user : null;
    }

    public function createUserAccount(string $email, string $password): void
    {
      $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
      $sql = 'INSERT INTO users(email, password) VALUES (:email, :password)';
      $statement = $this->pdo->prepare($sql);
      $statement->bindValue(':email', $email, PDO::PARAM_STR);
      $statement->bindValue(':password', $hashedPassword, PDO::PARAM_STR);
      $statement->execute();
      
    }
}