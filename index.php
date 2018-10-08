<!DOCTYPE html>
<html>  
    <?php 
    require "cms/functions.php";
    $page = currentPath();
    if ($page == "") {
        $page = "Home";
    }
    $page = searchForPage($page);
    if ($page != null) {
        fillPage($page);
    }
    else{
        fillPage("error"); // fill page with 404 error page
    }
    ?>
</html>