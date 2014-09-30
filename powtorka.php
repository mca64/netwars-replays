<?php
header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>
        <!-- TITLE -->
    </title>
    <!-- STYLE -->
    <style type="text/css">
    </style>
    <link rel="Stylesheet" type="text/css" href="style.css" />
    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.download-count').click(function() {
                var file_id = $(this).attr('id');
                $.ajax({
                    type: "POST",
                    url: 'licznik.php',
                    data: 'file_id=' + file_id
                });
            });
        });
    </script>
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
require "polaczenie.php";
require "polaczenie2.php";
polaczenie();
mysql_query("SET NAMES utf8");
mysql_query("SET CHARACTER SET utf8");
mysql_query("SET collation_connection = utf8_polish_ci");
$wynik  = mysql_query("SELECT * FROM info WHERE id='$nr' order by id desc;");
$rekord = mysql_fetch_array($wynik, MYSQL_NUM);
echo "<b>Wgrał: </b>", $rekord[66], "<br>";
echo "<b>Data: </b>", $rekord[45], "<br>";
echo "<b>Opis: </b>", $rekord[65], "<br><br>";
$sciezka = "\\upload\\$nr.jpg";
echo "<img src=\"$sciezka\" align=left />";
echo "<b>&nbsp&nbspMapa: </b>", $rekord[18], "<br>";
echo "<b>&nbsp&nbspWersja: </b>", $rekord[48], "<br>";
echo "<b>&nbsp&nbspCzas: </b>", $rekord[19];
if ($rekord[44] == "")
  {
    echo "<br><b>&nbsp&nbspMatchup: </b>", $rekord[8], "<br>";
    echo "<br>&nbsp&nbspGracze: <br>";
    $i = 0;
    while ($i < 8 && $rekord[$i] !== "")
      {
        $colHTML = dechex($rekord[$i + 57]);
        if (strlen($colHTML) < 6)
          {
            $padding = str_repeat("0", 6 - strlen($colHTML));
            $colHTML = $padding . $colHTML;
          }
        $nras = $rekord[$i + 28];
        echo "<b>&nbsp&nbsp", $rekord[$i], "</b>", " (", "<font color=\"#$colHTML\">" . $rekord[$i + 49] . "</font>", " ", "<img src=\"$nras.png\" />", ",   ", $rekord[$i + 20], " APM)<br>";
        $i++;
      }
  }
if ($rekord[44] == "1 vs 1")
  {
    echo "<br><b>&nbsp&nbspMatchup:</b> ", $rekord[8], "<br>";
  }
if ($rekord[44] == '2 vs 2' || $rekord[44] == '3 vs 3' || $rekord[44] == '4 vs 4')
  {
    echo "<br><b>&nbsp&nbspMatchup: </b>", $rekord[8], "<br>";
    echo "<br>&nbsp&nbspTeam 1:<br>";
    $i = 0;
    while ($i < 8)
      {
        $colHTML = dechex($rekord[$i + 57]);
        if (strlen($colHTML) < 6)
          {
            $padding = str_repeat("0", 6 - strlen($colHTML));
            $colHTML = $padding . $colHTML;
          }
        $nras = $rekord[$i + 28];
        if ($rekord[$i + 36] == "1")
            echo "<b>&nbsp&nbsp", $rekord[$i], "</b>", " (", "<font color=\"#$colHTML\">" . $rekord[$i + 49] . "</font>", " ", "<img src=\"$nras.png\" />", ",   ", $rekord[$i + 20], " APM)<br>";
        $i++;
      }
    echo "<br>&nbsp&nbspTeam 2:<br>";
    $i = 0;
    while ($i < 8)
      {
        $colHTML = dechex($rekord[$i + 57]);
        if (strlen($colHTML) < 6)
          {
            $padding = str_repeat("0", 6 - strlen($colHTML));
            $colHTML = $padding . $colHTML;
          }
        $nras = $rekord[$i + 28];
        if ($rekord[$i + 36] == "2")
            echo "<b>&nbsp&nbsp", $rekord[$i], "</b>", " (", "<font color=\"#$colHTML\">" . $rekord[$i + 49] . "</font>", " ", "<img src=\"$nras.png\" />", ",   ", $rekord[$i + 20], " APM)<br>";
        $i++;
      }
  }
?>
            <script type="text/javascript">
                function createButton(context, func) {
                    var button = document.createElement("input");
                    button.type = "button";
                    button.align = "right"
                    button.value = "Zobacz kto wygrał";
                    button.onclick = func;
                    context.appendChild(button);
                }
                jsvar = '<?= $rekord[44] ?>';
                if (jsvar == '1 vs 1') {
                    window.onload = function() {
                        createButton(document.body, function() {
                            alert('<?= $rekord[47] ?>');
                            highlight(this.parentNode.childNotes[1]);
                        });
                    }
                }
            </script>
<?php
if ($rekord[44] == "1 vs 1")
  {
    echo "&nbsp&nbspGracze: <br>";
    $i = 0;
    while ($i < $rekord[69])
      {
        if ($rekord[$i + 10] !== '1')
          {
            $colHTML = dechex($rekord[$i + 57]);
            if (strlen($colHTML) < 6)
              {
                $padding = str_repeat("0", 6 - strlen($colHTML));
                $colHTML = $padding . $colHTML;
              }
            $nras = $rekord[$i + 28];
            echo "<b>&nbsp&nbsp", $rekord[$i], "</b>", " (", "<font color=\"#$colHTML\">" . $rekord[$i + 49] . "</font>", " ", "<img src=\"$nras.png\" />", ",   ", $rekord[$i + 20], " APM)<br>";
          }
        $i++;
      }
  }
$adres = "/~nw/upload/$rekord[46].rep";
echo "<br><b>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<a href='$adres' class='download-count' id='$nr'>Pobierz!</a></b>";
?>	
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
<?php
polaczenie2();
mysql_query("SET NAMES utf8");
mysql_query("SET CHARACTER SET utf8");
mysql_query("SET collation_connection = utf8_polish_ci");
$wynik   = mysql_query("SELECT * FROM info WHERE nr='$nr' order by id asc;");
$srednia = 0;
$i       = 0;
while ($rekord = mysql_fetch_array($wynik, MYSQL_NUM))
  {
    $i++;
    echo "<table class=\"topic_list\"><colgroup><col class=\"dark col_temat\"><col class=\"light col_nick\"><col class=\"dark\"></colgroup>
     <thead>
	  <tr>
	   <th width=\"500\" align=\"left\">[#" . $i . "] " . $rekord[0] . "</th>
	   <th >" . $rekord[4] . "</th>
	   <th>" . $rekord[1] . " /10</th>
	  </tr>
	 </thead>
    <tbody>
    <tr><td colspan=4 class=\"topic\">" . $rekord[2] . "</td></tr>
    </tbody> </table> <br>";
  }
?>
            <form action="komentarz.php?nr=<?php
echo $nr;
?>" method="post">
                Komentarz:
                <textarea name="komentarz" rows=20 cols=40></textarea>
                <br>Nick:
                <input name="nickK" type="text" size="10" value="" />Ocena:
                <select name="ocena">
                    <option value="-" selected>-</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                </select>
                <input type="submit" value="Wyślij!" />
            </form>
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
