<?php
if (!session_id()) {
    session_start();
}

?>
<div class="navigation">
    <div class="container">
        <div class="logo" style="font-weight: bold; font-size: larger; color: blue;">
            <a href="/index.php">Main</a>
        </div>
        <ul>
            <?php
            if (isset($_SESSION['login']) && !empty($_SESSION['login'])) {
                if ($_SESSION['login'] == "moderator") {
                    ?>
                    <li>
                        <a href="/">Посты</a>
                    </li>
                    <li>
                        <a href="/logout.php">Выйти</a>
                    </li>
                    <?php
                } else if ($_SESSION['login'] == "admin") {
                    ?>
                    <li>
                        <a href="/admin/addPost.php">Добавить пост</a>
                    </li>
                    <li>
                        <a href="/admin/addCategory.php">Добавить категории</a>
                    </li>
                    <li>
                        <a href="/admin/addPreview.php">Добавить превью</a>
                    </li>
                    <li>
                        <a href="/admin/draftPosts.php">Черновики</a>
                    </li>
                    <li>
                        <a href="/logout.php">Выйти</a>
                    </li>
                    <?php
                } else {
                    ?>
                    <li>
                        <a href="/login.php">Войти</a>
                    </li>
                    <li>
                        <a href="/Sign_Up.php">Регистрация</a>
                    </li>
                    <?php
                }
            } else {
                ?>
                <li>
                    <a href="/login.php">Войти</a>
                </li>
                <li>
                    <a href="/Sign_Up.php">Регистрация</a>
                </li>
                <?php
            }
            ?>
        </ul>
    </div>
</div>
