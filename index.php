<?php
global $pdo;
require_once "./db/connect.php";
session_start();

$preview = $pdo->prepare("SELECT * FROM previews order by id desc LIMIT 6");
$preview->execute();
$previews = $array = $preview->fetchAll(PDO::FETCH_OBJ);

$post = $pdo->prepare("SELECT * FROM posts where published = 1 order by id desc");
$post->execute();
$posts = $array = $post->fetchAll(PDO::FETCH_OBJ);
?>

    <!DOCTYPE html>
    <html>
    <head>
        <title>Main panel</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>

    <body>
    <?php require "./navbar/header.php" ?>
    <h1>Main page</h1>
    <div class="gallery-container">
        <h2>Preview</h2>
        <div class="gallery">
            <?php foreach ($previews as $prev):?>
                <img src="admin/preview/<?php echo $prev->image?>" alt="Image">
            <?php endforeach; ?>
        </div>
    </div>
    <div class="card-container">
        <?php foreach ($posts as $serv): ?>
            <div class="card">
                <img src="admin/images/<?php echo $serv->image ?>" alt="<?php echo $serv->title ?>" class="card-img">
                <div class="card-info">
                    <h3 class="card-title"><?php echo $serv->title ?></h3>
                </div>
                <?php if($_SESSION['login'] == "admin"): ?>
                    <div class="admin-buttons">
                        <form style="text-align: center;" action="admin/realising/PostActions.php" method="post">
                            <input type="hidden" name="id_to_draft" value="<?php echo $serv->id; ?>">
                            <button type="submit" name="draft" class="btn btn-primary ">draft</button>
                        </form>
                        <form style="text-align: center;" action="admin/realising/PostActions.php" method="post">
                            <input type="hidden" name="id_to_delete" value="<?php echo $serv->id; ?>">
                            <button type="submit" name="delete" class="btn btn-primary ">delete</button>
                        </form>
                    </div>
                <?php endif; ?>
                <?php if($_SESSION['login'] == "moderator"): ?>
                <div class="admin-buttons">
                    <a href="moderator/updatePost.php?id=<?php echo $serv->id; ?>" class="black-link">
                        <button class="btn btn-primary ">edit</button>
                    </a>
            </div>
                <?php endif; ?>
        <?php endforeach; ?>
    </div>
    </body>

</html>
<style>
    body {
        margin: 0;
        font-family: Arial, sans-serif;
        background-color: #f8f9fa; /* Цвет фона */
        color: #212529; /* Цвет текста */
    }

    .gallery-container {
        width: 80%;
        margin: 20px auto; /* Отступы сверху и снизу */
    }

    .gallery {
        display: flex;
        overflow-x: auto;
        scroll-snap-type: x mandatory;
        gap: 10px; /* Расстояние между изображениями */
    }

    img {
        scroll-snap-align: start;
        max-width: 50%;
        height: auto; /* Автоматическая высота */
        border-radius: 10px; /* Скругление углов */
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Тень */
        transition: transform 0.3s ease; /* Плавное изменение масштаба */
    }

    img:hover {
        transform: scale(1.05); /* Увеличение размера при наведении */
    }

    .card-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px; /* Расстояние между карточками */
        margin: 20px auto; /* Отступы сверху и снизу */
    }

    .card {
        background-color: #fff;
        border-radius: 10px;
        overflow: hidden; /* Отсечение выходящих за пределы контейнера элементов */
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* Тень */
    }

    .card img {
        width: 100%;
        height: auto;
        border-radius: 10px 10px 0 0; /* Скругление углов у верхней части изображения */
    }

    .card-info {
        padding: 20px;
    }

    .card-title {
        margin: 0;
        font-size: 20px;
        font-weight: bold;
    }

    .admin-buttons {
        display: flex;
        justify-content: space-around; /* Выравнивание кнопок по центру */
        padding: 10px;
        border-top: 1px solid #dee2e6; /* Горизонтальная линия между карточками */
    }

    .admin-buttons button {
        background-color: #007bff; /* Цвет фона кнопки */
        color: #fff; /* Цвет текста кнопки */
        border: none; /* Убираем границу кнопки */
        border-radius: 5px; /* Скругление углов кнопки */
        padding: 10px 20px; /* Внутренние отступы кнопки */
        cursor: pointer; /* Изменение вида курсора при наведении */
        transition: background-color 0.3s ease; /* Плавное изменение цвета фона */
    }

    .admin-buttons button:hover {
        background-color: #0056b3; /* Изменение цвета фона при наведении */
    }
</style>