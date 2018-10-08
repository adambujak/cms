<?php
require "functions.php";
$dbname = $_POST["dbname"];
$tableName = $_POST["tableName"];
$column = $_POST["column"];
$value = $_POST["value"];
$id = $_POST["id"];
$conn = connectToDatabase($dbname);
$sql = "SELECT $column FROM $tableName WHERE $value = $id";
$result = runSQL($conn, $sql);
$ret = getSQLQuery($result);
if (count($ret)>0) {
    echo $ret[0];
}
else echo "error - nothing found";
closeConnection($conn);   

?>