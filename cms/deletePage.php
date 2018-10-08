<?php
require "functions.php";
if (isLoggedIn()) {
    $tableName = $_POST["tableName"];
    $conn = connectToDatabase("adambuja_Pages");
    $sql = "DROP TABLE $tableName";
    runSQL($conn, $sql);
    closeConnection($conn);
    echo "Deleted!";
}
?>