<?php 
require "config.php";
function connectToDatabase($dbname) {
    $conn = new mysqli(servername, username, password, $dbname); //connect to database with credentials
    if ($conn->connect_error) { //check for any errors 
        die("Connection failed: " . $conn->connect_error);
        return null;
    } 
    return $conn;
}
function runSQL($conn, $sql) { // run SQL Query, 
    $result = $conn->query($sql);
    return $result; //return result of SQL Query
}
function getSQLQuery($result) { //gets the result of a sql query, and outputs array of values
    $ret = array(); 
    if ($result->num_rows > 0) { //if there actually is some result
        while($row = $result->fetch_assoc()) { // this part adds everything to the return array
            $keys = array_keys($row);
            array_push($ret, $row[$keys[0]]);
        }
        return $ret;
    } 
    else {
        return null; //empty result
    }
}
function closeConnection($conn) {
    $conn->close(); // pretty self explanatory :) - I liked calling this function better than the method lol
}
function isLoggedIn() { //boolean
    if (isset($_COOKIE["login"])){ //checks if there is anything in the login cookie
        $id = $_COOKIE["login"]; // stores login cookie value to check the db value
    } else return false;
    $conn = connectToDatabase(credentials); // connects to credentials db
    $sql = "SELECT identification FROM login WHERE id = 1"; // gets unique identifier
    $result = runSQL($conn, $sql); 
    $retid = getSQLQuery($result)[0]; //uniqe identifier
    closeConnection($conn);
    if ($id == $retid && $retid != -1) return true; // -1 is set when they are logged out.
    return false;
}
function logout() {
    $conn = connectToDatabase(credentials); 
    $sql = "UPDATE login SET identification = -1 WHERE id = 1"; //set identifier to -1 so that we don't leave a valid identifier in there
    $result = runSQL($conn, $sql);
    $retid = getSQLQuery($result)[0];
    closeConnection($conn);
    if ($id == $retid && $retid != -1) return true;
    return false;
}
function getPageNames() { //returns array of page names
    $conn = connectToDatabase(pagesDB);
    $page = pagesDB; // did this so it can be added to the sql string easier.
    $sql = "SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_TYPE = 'BASE TABLE' AND TABLE_SCHEMA='$page'";
    $result = runSQL($conn, $sql);
    $ret = getSQLQuery($result);
    closeConnection($conn);
    return $ret;
}
function currentPath( $trim_query_string = false ) { //gets current path on website... mydomain/path -> returns path
    $pageURL = (isset( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] == 'on') ? "https://" : "http://";
    $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
    if( ! $trim_query_string ) {
        $path = explode("/", $pageURL); //split string by the slash
        return $path[3]; // output the third item in the split array because we always have an http:// in the url
    } 
    else {
        $url = explode( '?', $pageURL );
        $path = explode("/", $url[0]); // same as above
        return $path[2];
    }
}
function getValue($column, $page, $conn) {  // column-> which field to get from db page -> page name to get field for. conn-> mysqli connection to db so we don't have to reconnect.
    $sql = "SELECT $column FROM $page WHERE id = 1";
    $result = runSQL($conn, $sql);
    $ret = getSQLQuery($result);
    if (count($ret)>0) {
        echo $ret[0];
    }
    else echo "Sorry Something's Wrong.";
}
function getHeadValue($page, $conn) { // page -> page name to get head for. conn-> mysqli connection to db so we don't have to reconnect.
    getValue("Head", $page, $conn);
}
function getBodyValue($page, $conn) { // page -> page name to get body for. conn-> mysqli connection to db so we don't have to reconnect.
    getValue("Content", $page, $conn);
}
function getTitleValue($page, $conn) { // page -> page name to get title for. conn-> mysqli connection to db so we don't have to reconnect.
    getValue("Title", $page, $conn);
}
function searchForPage($page) {
    $pageNames = getPageNames();
    $found = false;
    $i=0; 
    while ($i < count($pageNames)) {
        if (strtolower($page) == strtolower($pageNames[$i])) {
            $found = true;
            break;
        }
        $i++;
    }
    if ($found) {
        if ($pageNames[$i][1] == "_"){ // for invisible pages
            return null;
        }
        return $pageNames[$i];
    } 
    return null;
}
function fillPage($page) {
    $conn = connectToDatabase(pagesDB);
    echo "<head>";// make sure to add the following to the head: <script src="/js/standard.js"></script> <link rel="stylesheet" href="/css/standard.css">
    echo getHeadValue($page, $conn);
    echo "<title>"; //
    echo getTitleValue($page, $conn);
    echo "</title>";
    echo "</head>";
    echo "<body>";
    echo getBodyValue($page, $conn);
    echo "</body>";
    closeConnection($conn);   
}
function getProjectContent($page) {
    $conn = connectToDatabase(pagesDB);
    echo getBodyValue($page, $conn);
    closeConnection($conn);   
}
?>