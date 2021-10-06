<?php 
require_once("config.php"); 
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
  header("location:../php/account.php");
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