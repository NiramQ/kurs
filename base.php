<?php
session_start();

$dbhost = "localhost"; // Адрес сервера MySQL
$dbname = "kinodatabase"; // Имя базы данных
$dbuser = "andrew"; // Пользователь базы данных
$dbpass = "andrew"; // Пароль пользователя базы данных

mysql_connect($dbhost, $dbuser, $dbpass) or die("Ошибка MySQL: " . mysql_error());
mysql_select_db($dbname) or die("Ошибка MySQL: " . mysql_error());
?>