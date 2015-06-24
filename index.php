<?php include "base.php"; ?>
<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <title>Автовокзал</title>
    <link href="css/style.css" rel="stylesheet">
</head>
<body>

<header>
    <div class="header-bg">
    </div>
</header>

<ul id="menu">
    <li><?php if (!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Username'])){
            echo "<a href='reg/index.php'>Вы зашли как, ".($_SESSION['Username'])."</a>" ;}
        else {echo "<a href='reg/index.php'>Войти</a>";}
        ?></li>
    <li><a href="raspisanie/index.php">Расписание автобусов</a></li>
    <li><a href="buy/index.php">Покупка билетов</a></li>
    <li><a href="vakansy/index.php">Вакансии</a></li>
    <li><a href="contact/index.php">Контакты</a></li>
    <li><a href="feedback/index.php">Обратная связь</a></li>
</ul>

<div id="content">
    <div style="text-align: center">
        <h1> Hello World!</h1>
        Данный сайт представляет собой курсовую работу по ТРС.</br>
        (^_^)
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
</html>