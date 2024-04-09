<?php
$user = "root";
$password= "";
$host = "localhost";
$db = "db_posts";
$dbn = "mysql:host=".$host.';dbname='.$db.';charset=utf8';

$pdo =new PDO($dbn, $user, $password);
$pdo->exec("USE $db");

try {

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $preview = "CREATE TABLE IF NOT EXISTS previews (
    id INT(6)  AUTO_INCREMENT PRIMARY KEY,
    image VARCHAR(50) NOT NULL,
    text VARCHAR(50) NOT NULL
)";

    $users = "CREATE TABLE IF NOT EXISTS users (
        id INT(6) AUTO_INCREMENT PRIMARY KEY,
        login VARCHAR(50),
        password VARCHAR(50) NOT NULL
    )";

    $category = "CREATE TABLE IF NOT EXISTS categories (
        id INT(6)  AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(50) NOT NULL
    )";

    $posts = "CREATE TABLE IF NOT EXISTS posts (
    id INT(6) AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(50) NOT NULL,
    image VARCHAR(50) NOT NULL,
    published BOOLEAN DEFAULT 1, 
    userId INT(6)  NOT NULL,
    categoryId INT(6)  NOT NULL,
    FOREIGN KEY (userId) REFERENCES users(id),
    FOREIGN KEY (categoryId) REFERENCES categories(id)
)";


    $pdo->exec($users);
    $pdo->exec($preview);
    $pdo->exec($category);
    $pdo->exec($posts);
} catch(PDOException $e) {
    echo "Ошибка при создании таблицы: " . $e->getMessage();
}

$conn = null;
?>


