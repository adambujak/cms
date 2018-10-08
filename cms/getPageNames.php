<?php
require "functions.php";
$ret = getPageNames(); //array of page names
$i=0;
while ($i < count($ret)) { //loop through and echo string of pages seperated by line break tag
    echo ($ret[$i]."<br>");
    $i++;
}
?>