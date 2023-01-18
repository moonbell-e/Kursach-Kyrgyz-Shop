<?php

session_start();
require_once 'connect.php';

$full_name = $_POST['full_name'];
$login = $_POST['login'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$password = $_POST['password'];
$password_confirm = $_POST['password_confirm'];

$check_login = mysqli_query($connect, "SELECT * FROM `users` WHERE `login` = '$login'");
if (mysqli_num_rows($check_login) > 0) {
    $_SESSION['message'] = 'Такой логин уже существует';
    header('Location: ../register.php');
    die();
}

$check_email = mysqli_query($connect, "SELECT * FROM `users` WHERE `email` = '$email'");
if (mysqli_num_rows($check_email) > 0) {
    $_SESSION['message'] = 'Такой email уже зарегистрирован';
    header('Location: ../register.php');
    die();
}

$check_phone = mysqli_query($connect, "SELECT * FROM `users` WHERE `phone` = '$phone'");
if (mysqli_num_rows($check_phone) > 0) {
    $_SESSION['message'] = 'Такой телефон уже зарегистрирован';
    header('Location: ../register.php');
    die();
}

$error_fields = [];

if ($login === '') {
    $error_fields[] = 'login';
}

if ($password === '') {
    $error_fields[] = 'password';
}

if ($full_name === '') {
    $error_fields[] = 'full_name';
}

if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error_fields[] = 'email';
}

if ($phone === '') {
    $error_fields[] = 'phone';
}


if ($password_confirm === '') {
    $error_fields[] = 'password_confirm';
}

if (!$_FILES['avatar']) {
    $error_fields[] = 'avatar';
}

if (!empty($error_fields)) {
    $_SESSION['message'] = 'Проверьте правильность ввода полей';
    header('Location: ../register.php');

    die();
}


if ($password === $password_confirm) {

    $path = 'uploads/' . time() . $_FILES['avatar']['name'];
    if (!move_uploaded_file($_FILES['avatar']['tmp_name'], '../' . $path)) {
        $_SESSION['message'] = 'Ошибка при загрузке сообщения';
        header('Location: ../register.php');
    }

    $password = md5($password);

    mysqli_query($connect, "INSERT INTO `users` (`id`, `full_name`, `login`, `email`, `phone`, `password`, `avatar`) VALUES (NULL, '$full_name', '$login', '$email','$phone', '$password', '$path')");

    $_SESSION['message'] = 'Регистрация прошла успешно!';
    header('Location: ../register.php');


} else {
    $_SESSION['message'] = 'Пароли не совпадают';
    header('Location: ../register.php');
}

?>

