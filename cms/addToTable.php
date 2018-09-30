<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$tableName = $_POST["tableName"];
$value = $_POST["tableValue"];
// sql to create table
$sql = "INSERT INTO $tableName (content)
VALUES ('$value')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>