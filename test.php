<?php

$dbname = "Pages";
$tableName = "Home";
$column = "Content";
$value = "id";
$id = "1";
$content = "The quick abrown fox jumaped over the lazy dog.";
$mysqli = new mysqli("localhost", "root", "", $dbname);
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }
    if ($stmt = $mysqli->prepare("UPDATE $tableName SET $column = ? WHERE id = ?")) { 
        $stmt->bind_param("ss", $content, $id);
        $stmt->execute();
        $stmt->fetch();
        $stmt->close();
    }
    $mysqli->close();
?>