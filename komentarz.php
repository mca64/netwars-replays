<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>
        <!-- TITLE -->
    </title>
    <!-- STYLE -->
    <link rel="Stylesheet" type="text/css" href="style.css" />
    <style type="text/css">
    </style>
    <!-- SCRIPT -->
</head>

<body>
    <div id="strona">
        <div id="logo">
        </div>
        <div id="main">
            <!-- LOGIN -->
            <br />
            <!-- CONTENT -->
<?php
require "polaczenie2.php";
require "polaczenie.php";
polaczenie2();
mysql_query("SET NAMES utf8");
mysql_query("SET CHARACTER SET utf8");
mysql_query("SET collation_connection = utf8_polish_ci");
mysql_query('SET NAMES \'utf8\'');
$zapytanie = "INSERT INTO info (nickK,ocena,komentarz,nr," . " data) 
               VALUES ('$nickK','$ocena','$komentarz','$nr'," . " now());";
$wynik     = mysql_query($zapytanie);
$srednia   = 0;
$i         = 0;
$wynik     = mysql_query("SELECT * FROM info WHERE nr='$nr' order by id asc;");
while ($rekord = mysql_fetch_array($wynik, MYSQL_NUM))
  {
    if ($rekord[1] !== '-')
      {
        $i++;
        $srednia = $srednia + $rekord[1];
      }
  }
$srednia = $srednia / $i;
$srednia = round($srednia, 1);
$srednia = "$srednia ($i)";
polaczenie();
mysql_query("SET NAMES utf8");
mysql_query("SET CHARACTER SET utf8");
mysql_query("SET collation_connection = utf8_polish_ci");
$zapytanie = ("UPDATE info SET srednia='$srednia' WHERE id='$nr'");
$wynik     = mysql_query($zapytanie);
?>		
        </div>
        <div id="menu-wrapper">
            <div id="gora-menu">
            </div>
            <div id="menu-content">
                <a href="http://netwars.pl/forum/">Forum</a>
                <br>
                <br>
                <a href="http://127.0.0.1/~nw/replays.php">Replays</a>
            </div>
            <!-- STREAMS -->
        </div>
    </div>
    <div id="footer">
        <!-- ONLINE -->
    </div>
</body>

</html>
