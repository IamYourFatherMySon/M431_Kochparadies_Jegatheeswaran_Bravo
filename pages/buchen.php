<?php

require_once('../php/config.php');

function auswahl(){
  global $auswahl;
}

$sql = "INSERT INTO kochkurs_user values (?, ?, date('Y-m-d')";