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
            echo "<a href='../reg/index.php'>Вы зашли как </a>";
        } else {
            echo "<a href='../reg/index.php'>Войти</a>";
        }
        ?></li>
    <li><a href="../raspisanie/index.php">Расписание автобусов</a></li>
    <li><a href="../buy/index.php">Покупка билетов</a></li>
    <li><a href="../vakansy/index.php">Вакансии</a></li>
    <li><a href="../contact/index.php">Контакты</a></li>
    <li><a href="../feedback/index.php">Обратная связь</a></li>
</ul>
<div id="content">
    <div style="text-align: center">
        <div id="main">
            <?php
            if (!empty($_POST['username']) && !empty($_POST['password'])) {
                // позволим пользователю зарегистрироваться
                $username = mysql_real_escape_string($_POST['username']);
                $password = md5(mysql_real_escape_string($_POST['password']));

                $checkusername = mysql_query("SELECT * FROM users WHERE Username = '" . $username . "'");

                if (mysql_num_rows($checkusername) == 1) {
                    echo "<h1>Ошибка</h1>";
                    echo "<p>Извините, такое имя пользователя уже используется. Вернитесь назад и попробуйте снова.</p>";
                } else {
                    $registerquery = mysql_query("INSERT INTO users (Username, Password) VALUES('" . $username . "', '" . $password . "')");
                    if ($registerquery) {
                        echo "<h1>Успех!</h1>";
                        echo "<p>Ваша учётная запись создана. <a href=\"index.php\">Авторизуйтесь</a>.</p>";
                    } else {
                        echo "<h1>Ошибка</h1>";
                        echo "<p>Мы не смогли вас зарегистрировать. Вернитесь назад и попробуйте снова.</p>";
                    }
                }
            } else {
                ?>
                <p>Пожалуйста заполните несколько полей ниже.</p>

                <form method="post" action="register.php" name="registerform" id="registerform">
                    <fieldset>
                        <label for="username"> Логин:</label><input type="text" name="username" id="username"><br>
                        <label for="password">Пароль:</label><input type="password" name="password" id="password"><br>
                        <input type="submit" name="register" id="register" value="Зарегистрироваться">
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
