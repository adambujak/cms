<?php
require "functions.php";
//make this dynamic and put into functions
if (isLoggedIn()) {
    $tableName = $_POST["tableName"];
    $value = $_POST["tableValue"]; 
    $conn = connectToDatabase("Pages");
    $sql = "SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_TYPE = 'BASE TABLE' AND TABLE_SCHEMA='Pages'";
    $result = runSQL($conn, $sql);
    $ret = getSQLQuery($result);
    closeConnection($conn);
    if (count($ret) > 0) {
        $i = 0;
        while ($i < count($ret)) {
            echo ($ret[$i]."<br>");
            $i++;
        }
    } 
}
else echo "notlogged";
/*

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
$conn->close();*/
?>