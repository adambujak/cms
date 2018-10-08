<?php
require "functions.php";
$conn = connectToDatabase("adambuja_Pages");
$sql = "SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_TYPE = 'BASE TABLE' AND TABLE_SCHEMA='adambuja_Pages'";
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

?>