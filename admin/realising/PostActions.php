<?php
global $pdo;
require_once "../db/connect.php";?>
<?php session_start(); ?>
<?php

// Обработка нажатия кнопки удаления
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete'])) {
        // Получение ID записи, которую нужно удалить
        $id_to_delete = $_POST['id_to_delete'];
        // SQL-запрос на удаление записи из таблицы
        $sql = "DELETE FROM posts WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id_to_delete]);

        // После удаления перенаправьте пользователя или выполните другие действия
        header("Location: /index.php");
        exit();
    }
}

// Обработка нажатия кнопки перевода в черновик
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
if (isset($_POST['draft'])) {
    $id_to_draft = $_POST['id_to_draft'];
    echo $id_to_draft;
    $sql = "UPDATE posts SET published = 0 WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id_to_draft]);

    // После обновления перенаправьте пользователя или выполните другие действия
    header("Location: /index.php");
    exit();
}
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
if (isset($_POST['publish'])) {
    $id_to_publish = $_POST['id_to_publish'];
    $sql = "UPDATE posts SET published = 1 WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id_to_publish]);

    header("Location: /index.php");
    exit();
}
}
?>
