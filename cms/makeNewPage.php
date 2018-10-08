<?php
require "functions.php";
if (isLoggedIn()) {
    $dbname = pagesDB;
    $pageName = $_POST["pageName"];
    $title = $_POST["title"];
    $conn = connectToDatabase($dbname);
    $sql = "CREATE TABLE $pageName ( 
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
        Content TEXT NOT NULL,
        Head TEXT,
        Title varchar(30)
    );";    // create new page in db
    $result = runSQL($conn, $sql);
    $sql = "INSERT INTO $pageName(Content, Head, Title) VALUES ('', '', '$title')";  //insert some initial values so we don't get errors.
    $result = runSQL($conn, $sql);
    closeConnection($conn);   
    echo "Page Created!";
}
else echo "notlogged";
?>