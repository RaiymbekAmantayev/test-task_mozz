<?php
global $pdo;
require_once "../db/connect.php";?>
<?php session_start(); ?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_SESSION['login'] == 'admin') {
    $title = isset($_POST["title"]) ? $_POST["title"] : "";
    $targetDir = "../preview/";
    $targetFile = $targetDir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));


    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            echo "Файл является изображением - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "Файл не является изображением.";
            $uploadOk = 0;
        }
    }

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
        echo "Файл ". basename($_FILES["image"]["name"]). " успешно загружен.";
    } else {
        echo "Ошибка загрузки файла.";
    }

    // Сохранить данные в базе данных
    $post = "INSERT INTO previews (image, text) VALUES (:image, :text)";
    $addPost = $pdo->prepare($post);

    $params = [
        "image" => basename($_FILES["image"]["name"]),
        ":text" => $title,
    ];

    $addPost->execute($params);

    header("Location: /admin/addPreview.php");
    exit();
}
?>
