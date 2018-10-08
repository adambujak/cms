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
    $conn = connectToDatabase("adambuja_credentials");
    $sql = "SELECT identification FROM login WHERE id = 1";
    $result = runSQL($conn, $sql);
    $retid = getSQLQuery($result)[0];
    closeConnection($conn);
    if ($id == $retid && $retid != -1) return true;
    return false;
}
function logout() {
    $conn = connectToDatabase("adambuja_credentials");
    $sql = "UPDATE login SET identification = -1 WHERE id = 1";
    $result = runSQL($conn, $sql);
    $retid = getSQLQuery($result)[0];
    closeConnection($conn);
    if ($id == $retid && $retid != -1) return true;
    return false;
}
function getPageNames() {
    $conn = connectToDatabase("adambuja_Pages");
    $sql = "SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_TYPE = 'BASE TABLE' AND TABLE_SCHEMA='adambuja_Pages'";
    $result = runSQL($conn, $sql);
    $ret = getSQLQuery($result);
    closeConnection($conn);
    return $ret;
}
function currentPath( $trim_query_string = false ) {
    $pageURL = (isset( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] == 'on') ? "https://" : "http://";
    $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
    if( ! $trim_query_string ) {
        $path = explode("/", $pageURL);
        return $path[3];
    } 
    else {
        $url = explode( '?', $pageURL );
        $path = explode("/", $url[0]);
        return $path[2];
    }
}
?>