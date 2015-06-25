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
            <input type="button" name="change" value="изменить" onclick="hideshow2()">
        </div>
    <?php } ?>
    <form method="post" action="index.php" name="buswaychange" id="buswaychange"><!--добавить потом hidden="true"-->
        <div>
            <label> откуда: </label><input type="text" name="from" id="from">
            <label> куда: </label><input type="text" name="where" id="where"></br >
            <label> выберите маршрут: </label><select>
                <option> 10</option>
                <option> 20</option>
            </select>
            <label> или добавьте новый:</label> <input type="text" name="numbus" id="numbus"></br >
        </div>
        <div>
        <label> отправление: </label><select>
            <option> 10</option>
            <option> 20</option>
        </select>
        <label>или добавьте новое:</label><input type="text" name="goway" id="goway"></br >
        <input type="submit" name="savebus" value="Сохранить">
        </div>
    </form>

    <form method="post" action="index.php" name="busway" id="busway">

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