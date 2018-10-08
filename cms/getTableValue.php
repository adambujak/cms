<?php
require "functions.php";
// get expected and required values from post request
$dbname = $_POST["dbname"];
if ($dbname == "pageDB") $dbname = pagesDB; //this is so I don't have to put the actual db name into the js
$tableName = $_POST["tableName"];
$column = $_POST["column"];
$value = $_POST["value"];
$id = $_POST["id"];
$conn = connectToDatabase($dbname);
$sql = "SELECT $column FROM $tableName WHERE $value = $id";
$result = runSQL($conn, $sql);
$ret = getSQLQuery($result);
if (count($ret)>0) {
    echo $ret[0]; //return first value. - we don't really have a need for multiple in this cms - maybe with future additions we may.
}
else echo "error - nothing found";
closeConnection($conn);
?>
