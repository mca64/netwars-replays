    <?php
function polaczenie()
  {
    $mysql_server = "localhost";
    $mysql_admin  = "root";
    $mysql_pass   = "krasnal";
    $mysql_db     = "repy";
    @mysql_connect($mysql_server, $mysql_admin, $mysql_pass) or die('Brak połączenia z serwerem MySQL.');
    @mysql_select_db($mysql_db) or die('Błąd wyboru bazy danych.');
  }
?>
