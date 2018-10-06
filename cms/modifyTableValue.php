<?php
require "functions.php";
if (isLoggedIn()) {
    $dbname = $_POST["dbname"];
    $tableName = $_POST["tableName"];
    $column = $_POST["column"];
    $value = $_POST["value"];
    $id = $_POST["id"];
    $content = $_POST["content"];
    $mysqli = new mysqli(servername, username, password, $dbname);
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }
    if ($stmt = $mysqli->prepare("UPDATE $tableName SET $column = ? WHERE $id = $value")) { //$stmt = $mysqli->prepare("UPDATE $tableName SET $column = ? WHERE $value = ?")
        $stmt->bind_param("s", $content);
        $stmt->execute();
        $stmt->fetch();
        $stmt->close();
    }
    echo "Page Edited!";
    $mysqli->close();
}
/*require "functions.php";
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
else echo "notlogged";*/
?>