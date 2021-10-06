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