<?php include "base.php"; ?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>Регистрация пользователей на PHP</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div id="main">

</div>
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
<div id="main">
    <?php
    if (!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Username'])) {
        // даём доступ пользователю к главной странице
        ?>
        <h1>Закрытый раздел!</h1>
        <p>Привет, <b><?= $_SESSION['Username'] ?></b>. Твоя почта - <b><?= $_SESSION['EmailAddress'] ?></b>.</p>
        <p><a href="logout.php">Выход</a></p>
    <?php
    } elseif (!empty($_POST['username']) && !empty($_POST['password'])) {
        // позволим пользователю войти на сайт
        $username = mysql_real_escape_string($_POST['username']);
        $password = md5(mysql_real_escape_string($_POST['password']));

        $checklogin = mysql_query("SELECT * FROM users WHERE Username = '" . $username . "' AND Password = '" . $password . "'");

        if (mysql_num_rows($checklogin) == 1) {
            $row = mysql_fetch_array($checklogin);
            $email = $row['EmailAddress'];

            $_SESSION['Username'] = $username;
            $_SESSION['EmailAddress'] = $email;
            $_SESSION['LoggedIn'] = 1;

            echo "<h1>Успех!</h1>";
            echo "<p>Сейчас вы будете перенаправлены в закрытый раздел.</p>";
            echo "<meta http-equiv='refresh' content='2;index.php'>";
        } else {
            echo "<h1>Ошибка</h1>";
            echo "<p>Прости, но мы не нашли такого аккаунта. Можешь <a href=\"index.php\">попробовать ещё раз</a>.</p>";
        }
    } else {
        // выводим форму для авторизации
        ?>
        <h1>Авторизация</h1>

        <p>Спасибо за то, что пришли! Войдите или <a href="register.php">зарегистрируйтесь</a>.</p>

        <form method="post" action="index.php" name="loginform" id="loginform">
            <fieldset>
                <label for="username">Логин:</label><input type="text" name="username" id="username"><br>
                <label for="password">Пароль:</label><input type="password" name="password" id="password"><br>
                <input type="submit" name="login" id="login" value="Войти">
            </fieldset>
        </form>

    <?php
    } ?>
</div>