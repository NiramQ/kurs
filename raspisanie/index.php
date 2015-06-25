<?php include "../base.php"; ?>
<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <title>Расписание</title>
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
    <li class="current"><span>Расписание автобусов</span></li>
    <li><a href="../buy/index.php">Покупка билетов</a></li>
    <li><a href="../vakansy/index.php">Вакансии</a></li>
    <li><a href="../contact/index.php">Контакты</a></li>
    <li><a href="../feedback/index.php">Обратная связь</a></li>
    <?php if (!empty($_SESSION['LoggedIn'])) echo "<li><a href='../reg/logout.php'>Выйти</a></li>"; ?>
</ul>

<div id="content">
    <?php if (!empty($_SESSION['LoggedIn']) && ($_SESSION['Username']) == "admin") {
        ?>
        <div id="twobuttons">
            <input type="button" name="prosmotr" value="просмотр" onclick="hideshow1();window.location.reload()"">
            <input type="button" name="change" value="добавить" onclick="hideshow2()">
        </div>
    <?php } ?>

    <form method="post" action="index.php" name="buswaychange" id="buswaychange"><!--добавить потом hidden="true"-->
        <label> куда: </label><input type="text" name="city" id="city">
        <input type="radio" name="direction" value="1" checked>Прямой рейс
        <input type="radio" name="direction" value="0">Обратный рейс </br>
        <label>рейс № </label><input type="text" name="numberbus" id="numberbus"></br>
        <label>время:</label><input type="text" name="hours" id="hours"><label>ч.</label><input type="text"
                                                                                                name="minutes"
                                                                                                id="minutes"><label>м.</label></br>
        <input type="submit" name="addbus" value="добавить">
        <input type="submit" name="searchbus" value="найти">
        <input type="submit" name="changebus" value="изменить">

        <?php
        if (($_POST['addbus']) && !empty($_POST['direction']) && !empty($_POST['city']) && !empty($_POST['hours']) && !empty($_POST['minutes']) && !empty($_POST['numberbus'])) {
            $add = mysql_query("INSERT INTO bus (Direction, City, Hours, Minutes, Numway) VALUES('" . $_POST['direction'] . "', '" . $_POST['city'] . "', '" . $_POST['hours'] . "', '" . $_POST['minutes'] . "', '" . $_POST['numberbus'] . "')");
            echo "</br>запись добавлена!";
        }
        ?>
        <?php
        if ($_POST['searchbus']) {
            mysql_query("Select * From bus Where (Direction = " . $_POST['direction'] . ")and(City =" . $_POST['city'] . ")and(Hours =" . $_POST['hours'] . ")and(Minutes = " . $_POST['minutes'] . ")and(Numway = " . $_POST['numberbus'] . ")");
            echo "</br>найдено!";
        } ?>

    </form>

    <form method="post" action="index.php" name="getways" id="getways">
        <?php

        $result =  mysql_query("Select * From bus");
        if (!$result) {
            echo 'Ошибка при выполнении запроса: ' . mysql_error();
            exit;
        }
        if (mysql_num_rows($result) > 0) {
            while ($row = mysql_fetch_assoc($result)) {
                echo $row["City"];
                echo $row["Hours"];
                echo $row["Minutes"];            }
        }
        ?>
    </form>


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

<script>
    function hideshow1() {
        document.getElementById("busway").hidden = false;
        document.getElementById("buswaychange").hidden = true;
    }
    function hideshow2() {
        document.getElementById("busway").hidden = true;
        document.getElementById("buswaychange").hidden = false;
    }
</script>