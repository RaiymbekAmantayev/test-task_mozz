<?php
global $pdo;
require_once "../db/connect.php";
?>
<?php
session_start();
?>
<?php

$login = $_POST['login'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

if ($password !== $confirm_password) {
    echo "Пароли не совпадают";
} else {

    $hashed_password = md5($password);

    $query = "INSERT INTO users (login, password) VALUES (:login, :password)";
    $statement = $pdo->prepare($query);

    $result = $statement->execute([
        ':login' => $login,
        ':password' => $hashed_password
    ]);

    if ($result) {
        echo "Пользователь успешно зарегистрирован";
        header('Location: /login.php');
    } else {
        echo "Ошибка при регистрации пользователя";
    }
}
?>
