<?php

use App\Dao\SpendingDao;

require_once __DIR__ . '/../../vendor/autoload.php';

$name = filter_input(INPUT_POST, 'name');
$categoryId = filter_input(INPUT_POST, 'categoryId', FILTER_SANITIZE_NUMBER_INT);
$amount = filter_input(INPUT_POST, 'amount', FILTER_SANITIZE_NUMBER_INT);
$accrualDate = filter_input(INPUT_POST, 'accrualDate');

if (
  empty($name) ||
  empty($categoryId) ||
  empty($amount) ||
  empty($accrualDate)
) {
  echo '<h2>入力が正しくありません</h2>';
  echo '<a href="./create.php">戻る</a>';
  die();
}

session_start();
if (!isset($_SESSION['user']['id'])) {
    header('Location: ./signin.php');
    exit();
}

$userId = $_SESSION['user']['id'];
$spendingDao = new SpendingDao;
$createSpendingSource = $spendingDao->createSpendingSource($name, $userId, $categoryId, $amount, $accrualDate);

header('Location: ./index.php');
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