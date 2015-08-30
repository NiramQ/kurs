<?php
session_start();

$dbhost = "localhost"; // Адрес сервера MySQL
$dbname = "busgo"; // Имя базы данных
$dbuser = "AndreyM"; // Пользователь базы данных
$dbpass = "MAndrey"; // Пароль пользователя базы данных

mysql_connect($dbhost, $dbuser, $dbpass) or die("Ошибка MySQL: " . mysql_error());
mysql_select_db($dbname) or die("Ошибка MySQL: " . mysql_error());
?>