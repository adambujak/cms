<?php
$dbName = $_POST["db"];
$tableName = $_POST["tableName"];
$column = $_POST["column"];
$value = $_POST["value"];
$id = $_POST["id"];
$content = $_POST["content"];


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
//UPDATE `Home` SET `Content` = 'aadfas' WHERE `Home`.`ID` = 1;
$sql = "UPDATE $tableName SET $column = '$content' WHERE $value = $id";
//$sql = "SELECT Content FROM Home WHERE id = 1"; 
$result = $conn->query($sql);

if ($conn->query($sql) === TRUE) {
    echo "Saved!";
} 
else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>