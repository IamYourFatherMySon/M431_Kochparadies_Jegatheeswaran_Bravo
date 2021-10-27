<?php
 session_start();
 require_once('../php/config.php');
 if ( isset($_GET['aktion']) and $_GET['aktion'] == "ausloggen") 
 {
   unset($_SESSION['eingeloggt']);
 } 
 $id = $_SESSION['id'];
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
    <form method="post" action="">
  <fieldset>
  <legend>Wählen Sie die Nummer des Kochkurses aus</legend>
    <?php
      $sql2 = "SELECT * FROM kochkurse ORDER BY zeitpunkt";
      if($result2 = $dbc->query($sql2)){
        if($result2->num_rows){
          $ds_gesamt2 = $result2->num_rows;
          $result2->free();
        }
        if($result2 = $dbc->query($sql2)){
          while($datensatz2 = $result2->fetch_object()){
            $daten2[] = $datensatz2;
          }
        }
      }
        foreach ($daten2 as $inhalt2) {
        ?>
       <input type="radio" id=<?php echo $inhalt2->id?> name="kochkurs" value=<?php echo $inhalt2->id?>>
       <label for=<?php echo $inhalt2->id?>><?php echo $inhalt2->id?></label> 
          <?php 
          } 
          if(isset($_POST['buchen'])){ 
            $value = $_POST["kochkurs"];
            $date=date('Y-m-d');
              

            $result = mysqli_query($dbc,"INSERT into kochkurs_user values('','$id','$value','$date')");
  
            if($result)
          {
          $done=2; 
          }
          else{
            $error[] ='Failed : Etwas ist schiefgelaufen';
          }
          }
          ?>
    </fieldset>
    <input type="submit" value="Buchen" name="buchen">
        </form>
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
      join kochkurse k on k.id = ku.kochkurs_id
      where r.id = $id";
      if($res = $dbc->query($sqlBuchung)){
        if($res->num_rows){
          $ds_gesamtBuchung = $res->num_rows;
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
        <a href="../php/logout.php" class="btn btn-danger ml-3">Logout</a>
    </p>
    <footer>
        <div id="flex">
          <ul>
            <li><a class="grösse" href="aboutus.html">About Us</a></li>
            <li><a class="grösse" href="impressum.html">Impressum</a></li>
          </ul>
        </div>
        </footer>
    </div>
</body>
</html>