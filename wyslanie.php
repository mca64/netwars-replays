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
require "polaczenie.php";
polaczenie();
mysql_query("SET NAMES utf8");
mysql_query("SET CHARACTER SET utf8");
mysql_query("SET collation_connection = utf8_polish_ci");
$wynik             = mysql_query("SELECT * FROM info  order by id desc;");
$rekord            = mysql_fetch_array($wynik, MYSQL_NUM);
$sciezka           = realpath(dirname(__FILE__));
$katalog_dla_repow = "upload";
$nr                = $rekord[46] + 1;
$plik_tmp          = $_FILES['plik']['tmp_name'];
$plik_nazwa        = $_FILES['plik']['name'];
$plik_rozmiar      = $_FILES['plik']['size'];
if (is_uploaded_file($plik_tmp))
  {
    move_uploaded_file($plik_tmp, "$sciezka/$katalog_dla_repow/$nr.rep");
    $info = php_bw_load_replay("$sciezka/$katalog_dla_repow/$nr.rep");
    if ($info->ErrorCode != 0)
        die("Nie można wczytać replay'a! : " . $info->ErrorString);
    $seconds       = $info->GameLength;
    $min           = floor($seconds / 60);
    $sec           = $seconds % 60;
    $czas          = "$min m $sec s";
    $mapa          = $info->Map->Name;
    $plikiSC       = "E:\\Program Files\\StarCraft Brood War by Monikon"; //sciezka dla plikow StarDat.mpq i BrooDat.mpq
    $rozpakuj_mape = php_bw_jpg_from_rep_dim($plikiSC, "C:\\usr\\krasnal\\www\\nw\\upload/$nr.rep", "C:\\usr\krasnal\\www\\nw\\upload/$nr.jpg", 256, REPASM_LOW_QUALITY, 50);
    $mu            = $info->Matchup;
    $ilosc         = $info->NumPlayer;
    $zwyc          = $info->Winner->Name;
    $wersja        = $info->Version->VersionName;
    $iloscgraczy   = $info->NumPlayer;
    $i             = 1;
    foreach ($info->Players as $player)
      {
        $kolor[]     = $player->ColorName;
        $kolorhtml[] = $player->ColorHTML;
        if ($info->Teams[0][0] == $player->Name)
            $tim[] = 1;
        if ($info->Teams[0][1] == $player->Name)
            $tim[] = 1;
        if ($info->Teams[0][2] == $player->Name)
            $tim[] = 1;
        if ($info->Teams[0][3] == $player->Name)
            $tim[] = 1;
        if ($info->Teams[1][0] == $player->Name)
            $tim[] = 2;
        if ($info->Teams[1][1] == $player->Name)
            $tim[] = 2;
        if ($info->Teams[1][2] == $player->Name)
            $tim[] = 2;
        if ($info->Teams[1][3] == $player->Name)
            $tim[] = 2;
        if ($player->IsObserver == 1)
          {
            $ilosc--;
          }
        $gracz[] = $player->Name;
        $apm[]   = $player->APM;
        $rasa[]  = $player->RaceName;
        $obs[]   = $player->IsObserver;
        $i++;
      }
    if (strlen($mu) - 1 == 8 && $ilosc == 8) //4v4
      {
        $tryb = "4 vs 4";
      }
    if (strlen($mu) - 1 == 6 && $ilosc == 6) // 3v3
      {
        $tryb = "3 vs 3";
      }
    if (strlen($mu) - 1 == 4 && $ilosc == 4) // 2v2
      {
        $tryb = "2 vs 2";
      }
    if ($ilosc == 2) // 1/1
      {
        $tryb = "1 vs 1";
      }
    /*  $akcje = php_bw_get_actions("$sciezka/$katalog_dla_repow/$nr.rep", "mca64[KDV]", REPASM_ALL_ACTIONS, 1);
    echo '<pre>';
    print_r($akcje);
    echo '</pre>'; 
    */
    mysql_query('SET NAMES \'utf8\'');
    $zapytanie = "INSERT INTO info (gracz1,gracz2,gracz3,gracz4,gracz5,gracz6,gracz7,gracz8,mu,ilosc,obs1,obs2,obs3,obs4,obs5,obs6,obs7,obs8,
      mapa,czas,apm1,apm2,apm3,apm4,apm5,apm6,apm7,apm8,rasa1,rasa2,rasa3,rasa4,rasa5,rasa6,rasa7,rasa8,tim1,tim2,tim3,tim4,tim5,tim6,tim7,tim8,tryb, " . " data,zwyc,wersja,      kolor1,kolor2,kolor3,kolor4,kolor5,kolor6,kolor7,kolor8,kolorhtml1,kolorhtml2,kolorhtml3,kolorhtml4,kolorhtml5,kolorhtml6,kolorhtml7,kolorhtml8,opis,nick,iloscgraczy) 
      VALUES ('$gracz[0]','$gracz[1]','$gracz[2]','$gracz[3]','$gracz[4]','$gracz[5]','$gracz[6]','$gracz[7]','$mu','$ilosc','$obs[0]','$obs[1]',
      '$obs[2]','$obs[3]','$obs[4]','$obs[5]','$obs[6]','$obs[7]','$mapa','$czas','$apm[0]','$apm[1]','$apm[2]','$apm[3]','$apm[4]','$apm[5]',
      '$apm[6]','$apm[7]','$rasa[0]','$rasa[1]','$rasa[2]','$rasa[3]','$rasa[4]','$rasa[5]','$rasa[6]','$rasa[7]','$tim[0]','$tim[1]','$tim[2]','$tim[3]','$tim[4]','$tim[5]','$tim[6]','$tim[7]','$tryb', " . " now(),'$zwyc','$wersja','$kolor[0]'
      ,'$kolor[1]','$kolor[2]','$kolor[3]','$kolor[4]','$kolor[5]','$kolor[6]','$kolor[7]','$kolorhtml[0]','$kolorhtml[1]','$kolorhtml[2]','$kolorhtml[3]','$kolorhtml[4]','$kolorhtml[5]','$kolorhtml[6]','$kolorhtml[7]','$opis','$nick','$iloscgraczy');";
    $wynik     = mysql_query($zapytanie);
  }
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
