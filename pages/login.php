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
               
              session_start();
              if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true){
                header('location:account.php');
              }

              require_once("../php/config.php");

              $email = $password = "";
              $email_err = $password_err = $login_err = "";

              if($_SERVER['REQUEST_METHOD'] == 'POST'){
                if(empty(trim($_POST['email']))){
                  $email_err = "Bitte geben Sie Ihre Email an.";
                }else{
                  $email = trim($_POST['email']);
                }
              

              if(empty(trim($_POST["password"]))){
                $password_err = "Bitte geben Sie Ihr Passwort ein.";
                } else{
                $password = trim($_POST["password"]);
              }

              if(empty($email_err) && empty($password_err)){
                $sql = 'SELECT id, email, passwort FROM registration WHERE email = ?';

                if($stmt = mysqli_prepare($dbc, $sql)){
                  mysqli_stmt_bind_param($stmt, "s", $param_email);
                  $param_email = $email;

                  if(mysqli_stmt_execute($stmt)){
                    mysqli_stmt_store_result($stmt);

                    if(mysqli_stmt_num_rows($stmt) == 1){
                      mysqli_stmt_bind_result($stmt, $id,$email, $hashed_password);

                      if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                          session_start();

                          $_SESSION['loggedin'] = true;
                          $_SESSION['id'] = $id;
                          $_SESSION['email'] = $email;

                          header('location:account.php');
                        }else{
                          $login_err = "Ungültige E-Mail oder Passwort.";
                        }
                      }
                    }else{
                      echo "Etwas ist schiefgelaufen. Bitte versuche es spöter nochmal.";
                    }
                    mysqli_stmt_close($stmt);
                  }
                }
                
              } 
              mysqli_close($dbc);
            
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