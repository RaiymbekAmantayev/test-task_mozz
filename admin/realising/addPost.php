<?php
global $pdo;
require_once "../db/connect.php";?>
<?php session_start(); ?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_SESSION['login'] == 'admin') {
    $title = isset($_POST["title"]) ? $_POST["title"] : "";
    $published = isset($_POST["radioValue"]) ? $_POST["radioValue"] : "";
    $categoryId = isset($_POST["categoryId"]) ? $_POST["categoryId"] : "";
    $login = isset($_SESSION["login"]) ? $_SESSION["login"] : "";
    $userQuery = $pdo->prepare("SELECT * FROM users WHERE login = :login");
    $userQuery->bindParam(':login', $login, PDO::PARAM_STR);
    $userQuery->execute();
    $user = $userQuery->fetch(PDO::FETCH_ASSOC);
    $userId = $user['id'];
    $targetDir = "../images/";
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
    $post = "INSERT INTO posts (title, image, published, userId,categoryId) VALUES (:title,  :image, :published, :userId, :categoryId)";
    $addPost = $pdo->prepare($post);

    $params = [
        ":title" => $title,
        "image" => basename($_FILES["image"]["name"]),
        ":published"=>$published,
        ":userId" => $userId,
        ":categoryId"=>$categoryId
    ];

    $addPost->execute($params);

    header("Location: /admin/addPost.php");
    exit();
}
?>
