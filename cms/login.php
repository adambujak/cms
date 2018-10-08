<?php
require "functions.php";
$userid = $_POST["username"]; 
$pass = $_POST["password"];
$dbname = credentials;
$conn = connectToDatabase($dbname);
$sql = "SELECT username FROM login WHERE id = 1;"; //gets username from credentials db
$result = runSQL($conn, $sql);
$username = getSQLQuery($result)[0];
$sql = "SELECT password FROM login WHERE id = 1;"; //password
$result = runSQL($conn, $sql);
$password = getSQLQuery($result)[0];
if ($userid == $username && $pass == $password) { //compare username and password
    $randID = rand(320,5000);  //random number between 320 and 5000 - this should be a much bigger range for better security
    setcookie('login', $randID, time() + (3600), "/"); // make the cookie - and have it expire in an hour
    echo "Success!"; 
    $sql = "UPDATE login SET identification = $randID WHERE id = 1;";  // update unique identifier in db
    runSQL($conn, $sql); 
    closeConnection($conn);
    return;
}
else {
    echo "invalid login";
    closeConnection($conn);
    return;
}
?>

