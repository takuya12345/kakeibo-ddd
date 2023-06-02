<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use App\Dao\UserDao;

$email = filter_input(INPUT_POST, 'email');
$password = filter_input(INPUT_POST, 'password');
$confirmPassword = filter_input(INPUT_POST, 'confirmPassword');

session_start();
if (empty($email) || empty($password) || empty($confirmPassword)) {
    $_SESSION['error'] = 'パスワードとメールアドレスを入力してください';
    $_SESSION['formInputs']['email'] = $email;
    header('Location: ./signup.php');
    exit();
}

if ($password !== $confirmPassword) {
    $_SESSION['error'] = 'パスワードが一致しません';
    $_SESSION['formInputs']['email'] = $email;
    header('Location: ./signup.php');
    exit();
}

$userDao = new UserDao();
$user = $userDao->fetchUserByEmail($email);

if ($user) {
    $_SESSION['error'] = 'すでに登録済みのメールアドレスです';
    $_SESSION['formInputs']['email'] = $email;
    header('Location: ./signup.php');
    exit();
}

$userDao = new UserDao();
$userDao->createUserAccount($email, $password);
$_SESSION['completedMessage'] = '登録が完了しました';
header('Location: ./signin.php');
exit();
?>