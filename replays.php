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
            <form name="dodajRep" method="post" action="dodaj.php" enctype="multipart/form-data">
                <input type="submit" value="Dodaj Replay" />
            </form>
            <table class="topic_list">
                <colgroup>
                    <col class="dark col_temat">
                        <col class="light col_nick">
                            <col class="dark">
                                <col class="light">
                                    <col class="dark">
                                        <col class="light">
                </colgroup>
                <thead>
                    <tr>
                        <th>Replay</th>
                        <th>Mapa</th>
                        <th>Tryb</th>
                        <th>Wgrał</th>
                        <th>Ocena</th>
                        <th>Pobrań</th>
                    </tr>
                </thead>
                <tbody>
<?php
require "polaczenie.php";
polaczenie();
mysql_query("SET NAMES utf8");
mysql_query("SET CHARACTER SET utf8");
mysql_query("SET collation_connection = utf8_polish_ci");
$wynik = mysql_query("SELECT * FROM info order by id desc;");
print "<UL>";
while ($rekord = mysql_fetch_array($wynik, MYSQL_NUM))
  {
    if ($rekord[44] == '2 vs 2' || $rekord[44] == '3 vs 3' || $rekord[44] == '4 vs 4') //
      {
        $i = 0;
        while ($i < 8)
          {
            if ($rekord[$i + 36] == "1")
              {
                $wyswietlanie_nazwy_repa = "" . $rekord[$i] . " ... vs ";
                break;
              }
            $i++;
          }
        $i = 0;
        while ($i < 8)
          {
            if ($rekord[$i + 36] == "2")
              {
                $wyswietlanie_nazwy_repa = "$wyswietlanie_nazwy_repa" . $rekord[$i] . "</B> ...";
                break;
              }
            $i++;
          }
      }
    if ($rekord[44] == '')
        $wyswietlanie_nazwy_repa = "" . $rekord[0] . " vs " . $rekord[1] . " vs ... ";
    if ($rekord[44] == '1 vs 1')
      {
        $i = 0;
        while ($i < 8)
          {
            if ($rekord[$i + 10] !== "1")
              {
                $wyswietlanie_nazwy_repa = "" . $rekord[$i] . " vs ";
                break;
              }
            $i++;
          }
        $i++;
        while ($i < 8)
          {
            if ($rekord[$i + 10] !== "1")
              {
                $wyswietlanie_nazwy_repa = "$wyswietlanie_nazwy_repa" . $rekord[$i] . "";
                break;
              }
            $i++;
          }
      }
    if ($rekord[44] == '')
        $rekord[44] = 'Inne';
    $adres = "/~nw/powtorka.php?nr=$rekord[46]";
    echo "<tr><td class=\"topic\"><a href=\"$adres\">" . $wyswietlanie_nazwy_repa . "</a></td>
		  <td class=\"posts\">" . $rekord[18] . "</td>
		  <td  class=\"posts\">" . $rekord[44] . "</td>
		  <td class=\"last\">" . $rekord[66] . "</td>
		  <td  class=\"posts\">" . $rekord[67] . "</td>
		  <td  class=\"posts\">" . $rekord[68] . "</td>
		  </tr>";
  }
?>	
                </tbody>
            </table>
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
