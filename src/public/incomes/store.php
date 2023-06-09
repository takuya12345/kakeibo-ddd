<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use App\Dao\IncomeDao;

$incomeSourceId = filter_input(INPUT_POST, 'incomeSourceId', FILTER_SANITIZE_NUMBER_INT);
$amount = filter_input(INPUT_POST, 'amount', FILTER_SANITIZE_NUMBER_INT);
$accrualDate = filter_input(INPUT_POST, 'accrualDate');

if (empty($incomeSourceId) || empty($amount) || empty($accrualDate)) {
  echo '<h2>入力が正しくありません</h2>';
  echo '<a href="./create.php">戻る</a>';
  die();
}

session_start();
if (!isset($_SESSION['user']['id'])) {
  header('Location: ./signin.php');
  exit();
}

$incomeDao = new IncomeDao;
$createIncomeSource = $incomeDao->createIncomeSource($incomeSourceId, $amount, $accrualDate);

header('Location: ./index.php');
exit();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>家計簿アプリ</title>
</head>

<body>
  <div class="container">
  </div>
</body>

</html>