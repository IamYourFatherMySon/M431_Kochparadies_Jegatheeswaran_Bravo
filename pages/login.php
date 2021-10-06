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
            <form method="post" action=''>
              <h2>Login</h2>
              <?php 
              require_once("../php/config.php"); 
              if(isset($_POST['login'])){ 
              $email = $_POST['email'];
              $password = $_POST['password'];
              $query = "select * from registration where (email = '$email')";
              $res = mysqli_query($dbc,$query);
              $numRows = mysqli_num_rows($res);
              if($numRows  == 1){ 
                      $row = mysqli_fetch_assoc($res);
                      if(password_verify($password,$row['passwort'])){
                        //$_SESSION["login_sess"]="1"; 
                        $_SESSION["email"]= $row['email'];
                header("location:account.php");
                      }
                      else{ 
                  header("location:login.php?loginerror=".$email);
                      }
                  }
                  else{
                header("location:login.php?loginerror=".$email);
                  }
              }
              ?>
              <label for="email">Email*: </label><br>
              <input type="email" name="email" required=""><br>
              <label for="password">Passwort*: </label><br>
              <input type="password" name="password" required=""><br>
              <input type="submit" name="login" value="Login" >
            </form>
          </div>
        </main>
      </div>
  </body>
</html>