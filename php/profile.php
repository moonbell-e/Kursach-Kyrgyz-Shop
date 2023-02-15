<?php
session_start();
if (!$_SESSION['user']) {
    header('Location: index.php');
}


if ($_SESSION['user']) {
    include 'orders.php';
}



?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Авторизация и регистрация</title>
    <link rel="stylesheet" href="static/css/register.css">
</head>
<body>
    <form>
     <img src="<?= $_SESSION['user']['avatar'] ?>" width="200" alt="">
     <h2 style="margin: 10px 0;"><?= $_SESSION['user']['full_name'] ?></h2>
     <a href="#" style="margin: 10px 0;"><?= $_SESSION['user']['email'] ?></a>
     <a href="#" style="margin: 10px 0;"><?= $_SESSION['user']['phone'] ?></a>
     <a href="/index.php"style="margin: 30px 0;">На Главную</a>
     <a href="vendor/logout.php" class="logout">Выход</a>
 </form>

</body>
</html>