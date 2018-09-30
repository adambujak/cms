<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "credentials";
$userid = $_POST["username"];
$pass = $_POST["password"];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


$sql = "SELECT username FROM login WHERE id = 1;";
$username = "";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $keys = array_keys($row);
        $username=$row[$keys[0]];
    }
} else {
    echo "error";
}
$sql = "SELECT password FROM login WHERE id = 1;";
$password = "";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $keys = array_keys($row);
        $password=$row[$keys[0]];
    }
} else {
    echo "error";
    return;
}
$userid = $_POST["username"];
$pass = $_POST["password"];


if ($userid == $username && $pass == $password) {
    $randID = rand(320,5000);
    setcookie('login', $randID, time() + (3600), "/");
    echo "Success!";
    $sql = "UPDATE login SET identification = $randID WHERE id = 1;";
    $conn->query($sql);
    $conn->close();
    return;
}
else {
    echo "invalid login";
    $conn->close();
    return;
}

?>

