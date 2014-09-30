<?php
require "polaczenie.php";
polaczenie();
echo $url;
$file_id = $_POST['file_id'];
echo $file_id;
mysql_query("SET NAMES utf8");
mysql_query("SET CHARACTER SET utf8");
mysql_query("SET collation_connection = utf8_polish_ci");
$zapytanie = ("UPDATE info SET iloscpobran=iloscpobran+1 WHERE id='$file_id'");
$wynik     = mysql_query($zapytanie);
?>
