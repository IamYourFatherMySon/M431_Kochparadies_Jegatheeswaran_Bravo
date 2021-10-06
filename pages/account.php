<?php
 session_start();
 require_once('../php/config.php');
 if ( isset($_GET['aktion']) and $_GET['aktion'] == "ausloggen") 
 {
   unset($_SESSION['eingeloggt']);
 } 
?>
<!DOCTYPE html>
<html lang="de">  
<head>
    <meta charset="UTF-8">
    <title>Willkommen</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div id="container">
    <h1>Unsere Kochkurse</h1>
    <table>
      <thead>
        <tr>
          <th data-priority="3">ID</th>
          <th>Kochkurs</th>
          <th>Datum und Zeit</th>
        </tr>
      </thead>
      <tbody>
      <?php
      $sql = "SELECT * FROM kochkurse ORDER BY zeitpunkt";
      if($result = $dbc->query($sql)){
        if($result->num_rows){
          $ds_gesamt = $result->num_rows;
          $result->free();
        }
        if($result = $dbc->query($sql)){
          while($datensatz = $result->fetch_object()){
            $daten[] = $datensatz;
          }
        }
      }
        foreach ($daten as $inhalt) {
        ?>
            <tr>
                <td>
                    <?php echo $inhalt->id; ?>
                </td>
                <td>
                    <?php echo $inhalt->bezeichnung; ?>
                </td>
                <td>
                    <?php echo $inhalt->zeitpunkt; ?>
                </td>
          </tr>
        <?php
        }
        ?>
      </tbody>  
    </table>
    <h2>Deine bereits gebuchten kochkurse</h2>
    <table>
      <thead>
        <tr>
          <th data-priority="3">ID</th>
          <th>user</th>
          <th>Kochkurs</th>
          <th>Buchungszeitpunkt</th>
        </tr>
      </thead>
      <tbody>
      <?php
      $sqlBuchung = "SELECT r.id,r.vorname, k.bezeichnung, ku.gebucht_am FROM registration r 
      join kochkurs_user ku on ku.user_id = r.id
      join kochkurse k on k.id = ku.kochkurs_id";
      if($res = $dbc->query($sqlBuchung)){
        if($res->num_rows){
          $ds_gesamtBuchung = $result->num_rows;
          $res->free();
        }
        if($res = $dbc->query($sqlBuchung)){
          while($datensatzBuchung = $res->fetch_object()){
            $datenBuchung[] = $datensatzBuchung;
          }
        }
      }
        foreach ($datenBuchung as $inhalt) {
        ?>
            <tr>
                <td>
                    <?php echo $inhalt->id; ?>
                </td>
                <td>
                    <?php echo $inhalt->vorname; ?>
                </td>
                <td>
                    <?php echo $inhalt->bezeichnung; ?>
                </td>
                <td>
                    <?php echo $inhalt->gebucht_am; ?>
                </td>
          </tr>
        <?php
        }
        ?>
      </tbody>  
    </table>
    <p> 
      <a href="reset-password.php" class="btn btn-warning">Passwort zurücksetzen</a></p>
      <p>
        <a href="../php/logout.php" class="btn btn-danger ml-3">Logout</a>
    </p>
    <footer>
        <div id="flex">
          <ul>
            <li><a class="grösse" href="pages/aboutus.html">About Us</a></li>
            <li><a class="grösse" href="pages/impressum.html">Impressum</a></li>
            <li><a class="grösse" href="pages/kochkurs.php">Kochkurs</a></li>
          </ul>
        </div>
        </footer>
    </div>
</body>
</html>