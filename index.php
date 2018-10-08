<!DOCTYPE html>
<html>
    <head>
        <script src="/js/standard.js"></script>
        <link rel="stylesheet" href="/css/standard.css">
    <?php 
        require "cms/functions.php";
        $pageNames = getPageNames();
        $dbname = "adambuja_Pages";
        $tableName = currentPath();
        if ($tableName == "") {
            $tableName="Home";
        }
        $found = false;
        $i=0; 
        while ($i < count($pageNames)) {
            if (strtolower($tableName) == strtolower($pageNames[$i])) {
                $found = true;
                break;
            }
            $i++;
        }
        if ($found) {
            $tableName = $pageNames[$i];
            $column = "Head";
            $value = "id";
            $id = "1";
            $conn = connectToDatabase($dbname);
            $sql = "SELECT $column FROM $tableName WHERE $value = $id";
            $result = runSQL($conn, $sql);
            $ret = getSQLQuery($result);
            if (count($ret)>0) {
                echo $ret[0];
            }
            else echo "Sorry Something's Wrong.";
            echo "</head>";
            echo "<body>";
            $column = "Content";
            $sql = "SELECT $column FROM $tableName WHERE $value = $id";
            $result = runSQL($conn, $sql);
            $ret = getSQLQuery($result);
            if (count($ret)>0) {
                echo $ret[0];
            }
            else echo "Sorry Something's Wrong.";
            echo "</body>";
            closeConnection($conn);   
        }
        ?>
</html>