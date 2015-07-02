<?php include "../base.php";
$userText1 = $_POST['selecttime'];
$userText2 = $_POST['selectcity'];
$userText3 = $_POST['counttickets']; ?>
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
    <?php if (!empty($_SESSION['LoggedIn'])) echo "<li class="."current"."><span>Покупка билетов</span></li>";?>
    <li><a href="../vakansy/index.php">Вакансии</a></li>
    <li><a href="../contact/index.php">Контакты</a></li>
    <li><a href="../feedback/index.php">Обратная связь</a></li>
    <?php if (!empty($_SESSION['LoggedIn'])) echo "<li><a href='../reg/logout.php'>Выйти</a></li>"; ?>
</ul>

<div id="content">
    <form action="index.php" method="post">
        <div name="buyticket" id="buyticket">
            <label>дата: </label><input type="date" name="buydate">
            <?php
            // if (($_POST['buydate']) < date("Y-m-d", mktime(0, 0, 0, date("m"), date("d") + 7, date("Y")))) {
            // echo "введите корректную дату";
            // }
            ?>
            <?php
            $cityresult = mysql_query("SELECT DISTINCT City FROM bus Group By City");
            $timeresult = mysql_query("Select Time from bus Where City Like '" . $_POST['selectcity'] . "' Group By Time");
            if (!$cityresult) {
                echo 'Ошибка при выполнении запроса: ' . mysql_error();
                exit;
            }
            if (mysql_num_rows($cityresult) > 0) {

                ?><label>город:</label> <select name="selectcity" onchange="this.form.submit()">
                <option id="hideoption" hidden=""><?php echo $userText2; ?></option><?php
                while ($row = mysql_fetch_assoc($cityresult)) {
                    ?>
                    <option><?php echo $row["City"]; ?> </option><?php
                }
                ?></select><?php
            }

            ?>
            <?php if (!$timeresult) {
                echo 'Ошибка при выполнении запроса: ' . mysql_error();
                exit;
            }
            if (mysql_num_rows($cityresult) > 0) {

                ?><label>время:</label> <select name="selecttime" onchange="this.form.submit()">
                <option id="hideoption" hidden=""><?php echo $userText1; ?></option><?php
                while ($row = mysql_fetch_assoc($timeresult)) {
                    ?>
                    <option name="timebus"><?php $date = new DateTime($row["Time"]);
                    echo date_format($date, 'H:i'); ?> </option><?php
                }
                ?></select><?php
            }
            ?>
            <!--            'and Time Like '". $_POST['selecttime'] ."-->
            <label>количество:</label><select name="counttickets" id="counttickets" onchange="this.form.submit()">
                <option hidden=""><?php echo $userText3; ?></option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
            </select>
            <label>цена: </label>
            <?php $cenaquery = mysql_query("Select * from bus Where City Like '" . $_POST['selectcity'] . "'and Time Like '" . $_POST['selecttime'] . ":00'");
            if (!$cenaquery) {
                echo 'Ошибка при выполнении запроса: ' . mysql_error();
                exit;
            }
            $row = mysql_fetch_assoc($cenaquery);
            ?><input type="text" id="cena" name="cenaticket"
                     value="<?php echo $ss = $row["Money"] * $_POST['counttickets']; ?>">

            <div id="bbtick">
                <input type="checkbox" checked><a href="index.html">я согласен с этими условиями</a>
                <input type="submit" name="bbtick" value="Купить!">
            </div>
        </div>
        <?php
        if (isset($_POST['bbtick'])) {
            $bquery = mysql_query("Insert Into usersbuy (Bid, BUser, BDate, BCity, BTime, Bcount, Bcena, Bcurrenttime) Values ('". 1 ."',". 2 .",'". 3 ."')");
        }
        ?>
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
