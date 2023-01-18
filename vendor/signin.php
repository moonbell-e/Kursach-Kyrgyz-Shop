<?php

session_start();
require_once 'connect.php';

$login = $_POST['login'];
$password = md5($_POST['password']);

$error_fields = [];

if ($login === '') {
    $error_fields[] = 'login';
}

if ($password === '') {
    $error_fields[] = 'password';
}

if (!empty($error_fields)) {
    $_SESSION['message'] = 'Проверьте правильность ввода полей';
    header('Location: ../login.php');

    die();
}

$check_user = mysqli_query($connect, "SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$password'");
if (mysqli_num_rows($check_user) > 0) {

    $user = mysqli_fetch_assoc($check_user);

    $_SESSION['user'] = [
        "id" => $user['id'],
        "full_name" => $user['full_name'],
        "avatar" => $user['avatar'],
        "email" => $user['email'],
        "phone" => $user['phone']
    ];

    header('Location: ../profile.php');

} else {
    $_SESSION['message'] = 'Неверный логин или пароль';
    header('Location: ../login.php');
}
?>

<pre>
    <?php
    print_r($check_user);
    print_r($user);
    ?>
</pre>
