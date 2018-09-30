<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Pages"; //changge back to 'Pages' if not working

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


$sql = "SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_TYPE = 'BASE TABLE' AND TABLE_SCHEMA='Pages'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $keys = array_keys($row);
        echo $row[$keys[0]]. "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>