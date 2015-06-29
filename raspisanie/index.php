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
    <form method="post" action="index.php" name="buswaychange" id="buswaychange"><!--добавить потом hidden="true"-->
        <label> куда: </label><input type="text" name="city" id="city">
        <input type="radio" name="direction" value="1" checked>Прямой рейс
        <input type="radio" name="direction" value="0">Обратный рейс </br>
        <label>рейс № </label><input type="text" name="numberbus" id="numberbus"></br>
        <label>время:</label><input type="text" name="hours" id="hours" min="0" max="23"><label>ч.</label><input type="text"
                                                                                                name="minutes"
                                                                                                id="minutes" min="1" max="59"><label>м.</label></br>
        <label>стоимость:</label><input type="text" name="money" id="money"><label> рублей</label></br>
        <input type="submit" name="addbus" value="добавить">
        <input type="submit" name="delbus" value="удалить">

        <?php
        if (($_POST['addbus']) && !empty($_POST['direction']) && !empty($_POST['city']) && !empty($_POST['hours']) && !empty($_POST['minutes']) && !empty($_POST['numberbus'])) {
            $add = mysql_query("INSERT INTO bus (Direction, City, Hours, Minutes, Numway) VALUES('" . $_POST['direction'] . "', '" . $_POST['city'] . "', '" . $_POST['hours'] . "', '" . $_POST['minutes'] . "', '" . $_POST['numberbus'] . "')");
            echo "</br>запись добавлена!";
        }
        if (isset($_POST['delbus']) && !empty($_POST['direction']) && !empty($_POST['city']) && !empty($_POST['hours']) && !empty($_POST['minutes']) && !empty($_POST['numberbus'])) {

        echo "</br>запись удалена!";}
        $delbus = mysql_query("Delete From bus Where Direction Like'" . $_POST['direction'] . "'and City Like '" . $_POST['city'] . "'and Hours Like '" . $_POST['hours'] . "'and Minutes Like '" . $_POST['minutes'] . "'and Numway Like '" . $_POST['numberbus'] . "'");

            ?>
    </form>
<?php } ?>

    </br>
    <form method="post" action="index.php" name="getways" id="getways">
        <input type="submit" name="searchbus" value="поиск"></br>

        <?php
        $cityresult = mysql_query("SELECT DISTINCT City FROM bus");
        if (!$cityresult) {
            echo 'Ошибка при выполнении запроса: ' . mysql_error();
            exit;
        }
        if (mysql_num_rows($cityresult) > 0) {

            ?> <select name="selectcity" id="selectcity"><option></option><?php
            while ($row = mysql_fetch_assoc($cityresult)) {
                ?>
                <option><?php echo $row["City"]; ?> </option><?php
            }
            ?></select></br><?php
        }


        //        $result = mysql_query("Select * From bus Where City Like '" . $_POST['selectcity'] . "' Order by Hours, Order by Minutes");
        $result = mysql_query("Select * From bus Where City Like '" . $_POST['selectcity'] . "' Order By Hours, Minutes");
        if (!$result) {
            echo 'Ошибка при выполнении запроса: ' . mysql_error();
            exit;
        }
        if (mysql_num_rows($result) > 0) {
            echo $_POST['selectcity'] . ' ';
            while ($row = mysql_fetch_assoc($result)) {
                echo $row["Hours"] . ':' . $row["Minutes"] . ' ';
            }
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
