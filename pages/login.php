<!DOCTYPE html>
<?php require_once("../php/config.php"); ?>
<html lang="de">
  <head>
    <title>Kochparadies</title>
    <link rel="icon" type="image/png" sizes="32x32" href="images/cooking.png">
    <meta name = "viewpoint" content ="width=device-width,initial-scale=1.0, user-scalable=no"> 
    <meta charset="utf-8">
    <meta name="author" content="Luca Bravo, Jeren Jegatheeswaran">
    <meta name="description" content="Diese Seite bietet einige Rezepte zum nachkochen."/> 
    <link href="../css/loginStyle.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Gruppo&family=Mukta+Mahee&display=swap" rel="stylesheet">
  </head>
  <body>
    <div id="container">
      <main>
          <div id="form">
            <form method="post" action='login_process.php'>
              <h2>Login</h2>
              <?php 
              if(isset($_GET['loginerror'])){
                $loginerror = $_GET['loginerror'];
              }
              if(!empty($loginerror)){  echo '<p class="errmsg">Ungütlige anmeldedaten, Bitte versuchen Sie es erneut..</p>'; }
              ?>
              <label for="email">Email*: </label><br>
              <input type="email" name="email" required=""><br>
              <label for="password">Passwort*: </label><br>
              <input type="password" name="password" required=""><br>
              <input id="submit" type="submit" value="Login" name="login">
            </form>
          </div>
        </main>
      </div>
  </body>
</html>