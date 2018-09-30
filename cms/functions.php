<?php 
require "config.php";
function connectToDatabase($dbname) {
    $conn = new mysqli(servername, username, password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        return null;
    } 
    return $conn;
}
function runSQL($conn, $sql) {
    $result = $conn->query($sql);
    return $result;
}
function getSQLQuery($result) {
    $ret = array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $keys = array_keys($row);
            array_push($ret, $row[$keys[0]]);
                //echo $row[$keys[0]]; //this only outputs first column, for more columns, write better function
        }
        return $ret;
    } 
    else {
        return null;
    }
}
function closeConnection($conn) {
    $conn->close();
}
function isLoggedIn() {
    if (isset($_COOKIE["login"])){
        $id = $_COOKIE["login"];
    } else return false;
    $conn = connectToDatabase("credentials");
    $sql = "SELECT identification FROM login WHERE id = 1";
    $result = runSQL($conn, $sql);
    $retid = getSQLQuery($result)[0];
    if ($id == $retid) return true;
    return false;
}
?>