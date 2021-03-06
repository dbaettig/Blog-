<?php
require '../partials/session.php';
require '../partials/database.php';

/*Form to login*/

$password = $_POST["password"];
$username = $_POST["username"];

$statement = $pdo->prepare("SELECT * FROM users WHERE username = :username");
$statement->execute(array(
  ":username" => $username
));

$fetched_user = $statement->fetch(PDO::FETCH_ASSOC);

if( password_verify($password, $fetched_user["password"]) ){
  $_SESSION["user"] = $fetched_user;
  $_SESSION["loggedIn"] = true;


header('Location:../profile.php');

  
} else {

  header("Location:../login.php?error=Wrong username&success=false");
  
}