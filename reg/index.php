<?php include "../base.php"; ?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>Регистрация</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<header>
    <div class="header-bg">
    </div>
</header>

<ul id="menu">
    <li><?php if (!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Username'])) {
            echo "<a href='../reg/index.php'>Вы зашли как, " . ($_SESSION['Username']) . "</a>";
        } else {
            echo "<a href='../reg/index.php'>Войти</a>";
        }
        ?></li>
    <li><a href="../raspisanie/index.php">Расписание автобусов</a></li>
    <?php if (!empty($_SESSION['LoggedIn'])) echo "<li><a href='../buy/index.php'>Покупка билетов</a></li>";?>
    <li><a href="../vakansy/index.php">Вакансии</a></li>
    <li><a href="../contact/index.php">Контакты</a></li>
    <li><a href="../feedback/index.php">Обратная связь</a></li>
    <?php if (!empty($_SESSION['LoggedIn'])) echo "<li><a href='logout.php'>Выйти</a></li>"; ?>

</ul>

<div id="content">
    <div style="text-align: center">
        <div id="main">
            <?php
            if (!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Username'])) {
                // даём доступ пользователю к главной странице
            } elseif (!empty($_POST['username']) && !empty($_POST['password'])) {
                // позволим пользователю войти на сайт
                $username = mysql_real_escape_string($_POST['username']);
                $password = md5(mysql_real_escape_string($_POST['password']));

                $checklogin = mysql_query("SELECT * FROM users WHERE Username = '" . $username . "' AND Password = '" . $password . "'");

                if (mysql_num_rows($checklogin) == 1) {
                    $row = mysql_fetch_array($checklogin);

                    $_SESSION['Username'] = $username;
                    $_SESSION['LoggedIn'] = 1;

                    echo "<h1>Успех!</h1>";
                    echo "<meta http-equiv='refresh' content='2;index.php'>";
                } else {
                    echo "<h1>Ошибка</h1>";
                    echo "<p>Прости, но мы не нашли такого аккаунта. Можешь <a href=\"index.php\">попробовать ещё раз</a>.</p>";
                }
            } else {
                // выводим форму для авторизации
                ?>

                <p>Спасибо за то, что пришли! Войдите или <a href="register.php">зарегистрируйтесь</a></p>

                <form method="post" action="index.php" name="loginform" id="loginform">
                    <fieldset>
                        <label for="username"> Логин:</label><input type="text" name="username" id="username"></br>
                        <label for="password">Пароль:</label><input type="password" name="password" id="password"></br>
                        <input type="submit" name="login" id="login" value="Войти">
                    </fieldset>
                </form>

            <?php
            } ?>

        </div>
    </div>
</div>


<footer>
    <div class="footer-bg">
        <div class="copyright">
            <p><strong>Учебный сайт «Автовокзал»</strong></p>

            <p>&copy; Маринкин Андрей Владимирович ИВТ11в</p>
        </div>
    </div>
</footer>
</body>


<?php
if (!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Username'])) {
    // даём доступ пользователю к главной странице
} elseif (!empty($_POST['username']) && !empty($_POST['password'])) {
    // позволим пользователю войти на сайт
} else {
    // выводим форму для авторизации
}
?>

