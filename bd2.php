<?php
$lacz      = mysql_connect("localhost", "root", "krasnal");
$zapytanie = 'CREATE DATABASE komentarze';
$wykonaj   = mysql_query($zapytanie);
$lacz      = mysql_select_db('komentarze');
$zapytanie = 'CREATE TABLE info (' . 'nickK VARCHAR(20),' . 'ocena VARCHAR(2),' . 'komentarz TEXT NOT NULL,' . 'nr VARCHAR(6),' . 'data DATETIME,' . 'id INT NOT NULL AUTO_INCREMENT,' . 'PRIMARY KEY(id)' . ')';
$wykonaj   = mysql_query($zapytanie);
?>
