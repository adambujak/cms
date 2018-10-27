<?php
require "functions.php";
$usermail = $_POST["email"];
$message = $_POST["message"];
$name = $_POST["name"];
mail("adam@adambujak.com", $name. " - ". $usermail, $message);
?>