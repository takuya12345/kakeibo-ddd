<?php

use App\Dao\SpendingDao;
use App\Domain\ValueObject\User\UserName;
use App\Domain\ValueObject\User\UserId;
use App\Domain\ValueObject\User\SpendingsAmount;
use App\Domain\ValueObject\User\CategoryId;
use App\Domain\ValueObject\User\AccrualDate;
use App\UseCase\CreateSpendings\UseCaseInput;
use App\UseCase\CreateSpendings\UseCaseInteractor;
use App\UseCase\CreateSpendings\UseCaseOutput;
use App\Infrastructure\Redirect\Redirect;

require_once __DIR__ . '/../../vendor/autoload.php';

$name = filter_input(INPUT_POST, 'name');
$categoryId = filter_input(INPUT_POST, 'categoryId', FILTER_SANITIZE_NUMBER_INT);
$amount = filter_input(INPUT_POST, 'amount', FILTER_SANITIZE_NUMBER_INT);
$spendingsAccrualDate = filter_input(INPUT_POST, 'accrualDate');

try {
  session_start();
  if (
    empty($name) ||
    empty($categoryId) ||
    empty($amount) ||
    empty($spendingsAccrualDate)
  ) {
    echo '<h2>入力が正しくありません</h2>';
    echo '<a href="./create.php">戻る</a>';
    die();
  }
  
  if (!isset($_SESSION['user']['id'])) {
      header('Location: ./signin.php');
      exit();
  }
  
  $userName = new UserName($name);
  $userId = new UserId($_SESSION['user']['id']);
  $spendingsAmount = new SpendingsAmount($amount);
  $categoryId = new CategoryId($categoryId);
  $accrualDate = new AccrualDate($spendingsAccrualDate);
  $spendingDao = new SpendingDao;
  
  $spendingsUseCaseInput = new UseCaseInput($userName, $userId, $spendingsAmount, $categoryId, $accrualDate);
  $spendingsUseCaseInteractor = new UseCaseInteractor($spendingsUseCaseInput, $spendingDao);
  $spendingsUseCaseOutput = $spendingsUseCaseInteractor->handler();
  // true or falseで判定
  
  if (!$spendingsUseCaseOutput->isSuccess()) {
    throw new Exception($spendingsUseCaseOutput->message());
  }
  $_SESSION['message'] = $spendingsUseCaseOutput->message();
  Redirect::handler('./index.php');
} catch (Exception $e) {
  $_SESSION['errors'][] = $e->getMessage();
  $_SESSION['user']['userName'] = $userName;
  $_SESSION['user']['spendingsAmount'] = $spendingsAmount;
  $_SESSION['user']['AccrualDate'] = $accrualDateAccrualDate;
  Redirect::handler('./index.php');
}

exit();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>保存失敗</title>
</head>

<body>
  <div class="container">
    <h2><?php echo $message; ?></h2>
    <a href="./index.php">
      <p>投稿一覧へ<p>
    </a>
  </div>
</body>

</html>