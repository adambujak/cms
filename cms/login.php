<?php
require "functions.php";
$userid = $_POST["username"];
$pass = $_POST["password"];
$dbname = "credentials";
$conn = connectToDatabase($dbname);
$sql = "SELECT username FROM login WHERE id = 1;";
$result = runSQL($conn, $sql);
$username = getSQLQuery($result)[0];
$sql = "SELECT password FROM login WHERE id = 1;";
$result = runSQL($conn, $sql);
$password = getSQLQuery($result)[0];
if ($userid == $username && $pass == $password) {
    $randID = rand(320,5000);
    setcookie('login', $randID, time() + (3600), "/");
    echo "Success!";
    $sql = "UPDATE login SET identification = $randID WHERE id = 1;";
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

