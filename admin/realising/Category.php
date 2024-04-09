<?php
global $pdo;
require_once "../db/connect.php";?>
<?php session_start(); ?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = isset($_POST["title"]) ? $_POST["title"] : "";

    $cat = "INSERT INTO categories (title) VALUES (:title)";
    $add = $pdo->prepare($cat);

    $params = [
        ":title" => $title,
    ];

    $add->execute($params);

    header("Location: /admin/addCategory.php");
    exit();
}
?>
