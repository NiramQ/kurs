<?php include "../base.php"; ?>
<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <title>Автовокзал</title>
    <link href="../css/style.css" rel="stylesheet">
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
    <li class="current"><span>Покупка билетов</span></li>
    <li><a href="../vakansy/index.php">Вакансии</a></li>
    <li><a href="../contact/index.php">Контакты</a></li>
    <li><a href="../feedback/index.php">Обратная связь</a></li>
    <?php if (!empty($_SESSION['LoggedIn'])) echo "<li><a href='../reg/logout.php'>Выйти</a></li>"; ?>
</ul>

<div id="content">
    <form action="index.php" method="post">
        <div name="buyticket" id="buyticket">
        <label>укажите дату: </label><input type="date" name="buydate"></br>
        <?php
//        if (($_POST['buydate']) < date("Y-m-d", mktime(0, 0, 0, date("m"), date("d") + 7, date("Y")))) {
//            echo "введите корректную дату";
//        }
        $cityresult = mysql_query("SELECT DISTINCT City FROM bus");
        if (!$cityresult) {
            echo 'Ошибка при выполнении запроса: ' . mysql_error();
            exit;
        }
        if (mysql_num_rows($cityresult) > 0) {

            ?><label>выберите город:</label> <select name="selectcity" id="selectcity"><option></option><?php
            while ($row = mysql_fetch_assoc($cityresult)) {
                ?>
                <option><?php echo $row["City"]; ?> </option><?php
            }
            ?></select></br><?php
        }
        ?>
        </div>
    </form>
</div>


<footer>
    <div class="footer-bg">
        <div class="copyright">
            <p><strong> Учебный сайт «Автовокзал» </strong></p>

            <p>&copy; Маринкин Андрей Владимирович ИВТ11в </p>
        </div>
    </div>
</footer>

</body>
</html>