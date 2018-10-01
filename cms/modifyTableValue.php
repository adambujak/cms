<?php
require "functions.php";
if (isLoggedIn()) {
    $dbname = $_POST["dbname"];
    $tableName = $_POST["tableName"];
    $column = $_POST["column"];
    $value = $_POST["value"];
    $id = $_POST["id"];
    $content = $_POST["content"];
    $conn = connectToDatabase($dbname);
    $sql = "UPDATE $tableName SET $column = '$content' WHERE $value = $id";
    $result = runSQL($conn, $sql);
    if ($conn->query($sql) === TRUE) {
    echo "Saved!";
    } 
    else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    closeConnection($conn);
}
else echo "notlogged";
?>