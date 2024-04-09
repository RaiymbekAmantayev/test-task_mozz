<?php
global $pdo;
require_once "../db/connect.php";
session_start();
$category = $pdo->prepare("SELECT * from categories");
$category->execute();
$categories = $category->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin panel</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
<?php require "../navbar/header.php" ?>
<div class="container">
    <h1>Add new preview</h1>
    <?php if (isset($_SESSION['login'])): ?>
        <p style="text-align: center">Good day, <?php echo $_SESSION['login']; ?></p>
    <?php endif; ?>
    <a href="/" class="d-block text-center mb-4">Main Page</a>

    <form action="realising/addPreview.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Enter title" name="title" required>
        </div>
        <div class="form-group">
            <input type="file" class="form-control" name="image" id="image" accept="image/*" required>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Save</button>
    </form>
</div>

</body>
</html>
<style>
    body {
        background-size: cover;
        background-position: center;
        height: 100vh;
        display: flex;
        align-items: center;
    }

    .container {
        background-color: rgb(37 35 38 / 90%);
        padding: 30px;
        border-radius: 10px;
    }

    .form-control {
        border-radius: 5px;
    }

    h1 {
        text-align: center;
        color: #fff
    }

    p {
        color: #fff
    }
    label{
        color: #fff;
    }
</style>