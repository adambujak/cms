<?php
$dbName = $_POST["db"];
$tableName = $_POST["tableName"];
$column = $_POST["column"];
$value = $_POST["value"];
$id = $_POST["id"];


$servername = "localhost";
$username = "root";
$password = "";
$dbname = $dbName;

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT $column FROM $tableName WHERE $value = $id";
//$sql = "SELECT Content FROM Home WHERE id = 1"; 
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $keys = array_keys($row);
        echo $row[$keys[0]];
    }
} else {
    echo "0 results";
}
$conn->close();
?>