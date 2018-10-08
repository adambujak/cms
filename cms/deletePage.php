<?php
require "functions.php";
if (isLoggedIn()) { //we want to make sure whoever sent this request is logged in.
    $tableName = $_POST["tableName"]; // name of page to delete - sent with POST request.
    $conn = connectToDatabase(pagesDB);
    $sql = "DROP TABLE $tableName"; // drop table from db
    runSQL($conn, $sql);
    closeConnection($conn);
    echo "Deleted!";
}
?>