<?php
require "functions.php";
if (isLoggedIn()) {
    $dbname = "Pages";
    $pageName = $_POST["pageName"];
    $title = $_POST["title"];
    $conn = connectToDatabase($dbname);
    $sql = "CREATE TABLE $pageName (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
        Content TEXT NOT NULL,
        Title varchar(30)
    );";   
    $result = runSQL($conn, $sql);
    $sql = "INSERT INTO $pageName(Content, Title) VALUES ('', '$title')";  
    $result = runSQL($conn, $sql);
    closeConnection($conn);   
    mkdir($pageName);
    echo "Page Created!";
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
$q = $_REQUEST["tableName"];
$a = $_REQUEST["tableValue"];
// sql to create table
$sql = "CREATE TABLE $q (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
$a VARCHAR(30) NOT NULL
)";    


if ($conn->query($sql) === TRUE) {
    echo "Table $q created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}
$conn->close();*/
?>