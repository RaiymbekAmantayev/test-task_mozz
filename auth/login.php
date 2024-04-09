<?php
session_start();
global $pdo;
require_once "../db/connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST["login"];
    $password = $_POST["password"];

    $query = "SELECT * FROM users WHERE login = :login";
    $statement = $pdo->prepare($query);
    $statement->execute([':login' => $login]);
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    if ($user && md5($password) === $user['password']) {
        $_SESSION['roleId'] = $user['roleId'];
        $_SESSION['login'] = $user['login'];

        header("Location: /");
        exit();
    } else {
        echo "Неверный логин или пароль";
    }
}
?>