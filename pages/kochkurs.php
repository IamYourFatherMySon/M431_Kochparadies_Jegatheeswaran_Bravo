<!DOCTYPE html>
<?php require_once('../php/config.php'); ?>
<html lang="de">
  <head>
    <title>Kochparadies</title>
    <link rel="icon" type="image/png" sizes="32x32" href="images/cooking.png">
    <meta name = "viewpoint" content ="width=device-width,initial-scale=1.0, user-scalable=no"> 
    <meta charset="utf-8">
    <meta name="author" content="Luca Bravo, Jeren Jegatheeswaran">
    <meta name="description" content="Diese Seite bietet einige Rezepte zum nachkochen."/> 
    <link href="../css/kochkursStyle.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Gruppo&family=Mukta+Mahee&display=swap" rel="stylesheet">
  </head>
  <body>
    <div id="container">
      <header>
        <h1>Kochparadies</h1>
      </header>
      <main>
        <h2 class="padding">Kochkurs</h2>
          <p class="padding">
            Falls du dich nun durch die Kochrezepte inspiriert fühlst, kannst du dich für unseren Kochkurs einschreiben<br>
            In diesem Kochkurs werden wir zusammen eines der Rezepte zusammen nachkochen und Schritt für Schritt erklären wir dir, wie man die Gerichte am besten kocht.<br>
            Alles was du tun musst, ist dich registrieren, ein Rezept und ein Datum auswählen und schon bis du ready!<br>
            Wir wünschen dir viel Spass beim Kochen!
          </p>
          <?php
          if(isset($_POST['signup'])){
            extract($_POST);
            if(strlen($vorname) < 3){
              $error[] = 'Der Vorname sollte aus mindestens 3 Buchstaben bestehen.';
            }
            if(strlen($vorname) > 30){
              $error[] = 'Der Vorname sollte nicht länger als 30 Buchstaben sein.';
            }
            if(!preg_match("/^[A-Za-z _]*[A-Za-z ]+[A-Za-z _]*$/", $vorname)){
              'Ungültiger Vorname. Bitte gib nur Buchtsaben ein.';
            }
            if(strlen($nachname) < 3){
              $error[] = 'Der Nachname sollte aus mindestens 3 Buchstaben bestehen.';
            }
            if(strlen($nachname) > 30){
              $error[] = 'Der Nachname sollte nicht länger als 30 Buchstaben sein.';
            }
            if(!preg_match("/^[A-Za-z _]*[A-Za-z ]+[A-Za-z _]*$/", $nachname)){
              'Ungültiger Nachname. Bitte gib nur Buchtsaben ein.';
            }
            if(strlen($email) > 50){ 
                      $error[] = 'Email: Maximale Länge 50 Buchstaben';
                  }
            if(strlen($password) < 5){  
                      $error[] = 'Das Passwort muss aus mindestens 6 Zeichen bestehen.';
                  }      
            if($passwordConfirm ==''){
                      $error[] = 'Bitte Passwort bestätigen.';
                  }
                  if($password != $passwordConfirm){
                      $error[] = 'Passwörter stimmen nicht überein.';
                  }
                    
                  $sql = "select * from registration where (email='$email');";
                $res=mysqli_query($dbc,$sql);
              if (mysqli_num_rows($res) > 0) {
                  $row = mysqli_fetch_assoc($res);
          
              if($email==$row['email'])
              {
                    $error[] ='Email existiert bereits.';
                  } 
                }
              if(!isset($error)){ 
                    $date=date('Y-m-d');
                    $options = array("cost" => 4);
                    $password = password_hash($password,PASSWORD_BCRYPT,$options);
                      
                    $result = mysqli_query($dbc,"INSERT into registration values('','$vorname','$nachname','$email','$password')");
          
                    if($result)
              {
              $done=2; 
              }
              else{
                $error[] ='Failed : Etwas ist schiefgelaufen';
              }
            }
   
          }
          ?>
          <?php 
            if(isset($error)){ 
            foreach($error as $error){ 
              echo '<p class="errmsg">&#x26A0;'.$error.' </p>'; 
            }
          }
          ?>
          <?php if(isset($done)) 
            { ?>
            <div class="successmsg"><span style="font-size:100px;">&#9989;</span> <br> Du hast dich erfolgreich registriert. <br> <a href="login.php" style="color:#fff;">Login here... </a> </div>
              <?php } else { ?>
          <div id="form" class="registration-form">
            <form method="post" action=''>
              <h2>Registrieren</h2>
              <label for="vorname">Vorname*: </label><br>
              <input type="text" name="vorname" value="<?php if(isset($error)){ echo $_POST['vorname'];}?>" required=""><br>
              <label for="nachname">Nachname*: </label><br>
              <input type="text" name="nachname" value="<?php if(isset($error)){ echo $_POST['nachname'];}?>" required=""><br>
              <label for="email">Email*: </label><br>
              <input type="email" name="email" value="<?php if(isset($error)){ echo $_POST['email'];}?>" required=""><br>
              <label for="password">Passwort*: </label><br>
              <input type="password" name="password" required=""><br>
              <label for="passwordConfirm">Confirm Password*: </label>
              <input type="password" name="passwordConfirm" class="form-control" required=""><br>
              <input id="submit" type="submit" name="signup" value="Registrieren">
            </form>
            <?php } ?> 
            <p id="login">Schon registriert? <a href="login.php">Einloggen</a></p>
          </div>
        </main>
        <footer>
          <div id="flex">
            <ul>
              <li><a class="grösse" href="aboutus.html">About Us</a></li>
              <li><a class="grösse" href="impressum.html">Impressum</a></li>
              <li><a class="grösse" href="../home.html">Home</a></li>
            </ul>
          </div>
          </footer>
      </div>
  </body>
</html>