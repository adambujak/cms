function makeDB(str, row) {
    if (str.length == 0) { 
        return;
    } 
    else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("POST", "makeNewTable.php?tableName=" + str +"&tableValue="+row, true);
        xmlhttp.send();
    }
}
function addToDatabase(db, value) {
    $.ajax({
        data: 'tableName=' + db + "&tableValue=" + value,
        url: 'addToTable.php',
        method: 'POST', // or GET
        success: function(msg) {
            alert(msg);
        }
    });
}
function isLoggedIn() {
    if ($.cookie('login') != null) return true;
    return false;
}
function logout() {
    $.removeCookie("login");
    hide(document.getElementById('logout'));
}
function hide(x) {
    x.style.display = "none";
}
function show(x) {
    x.style.display = "block";
}
window.onload = function ()  {
    var x = document.getElementById('logout');
    if (isLoggedIn()) {
        show(x);
    }
    else hide(x);
}
function getDatabaseValue(db, tableName, column, value, id) { // SELECT column FROM db WHERE value = id
    $.ajax({
        data: 'db=' + db + '&tableName=' + tableName + "&column=" + column + "&value=" + value + "&id=" + id,
        url: 'getTableValue.php',
        method: 'POST', // or GET
        success: function(msg) {return msg;}
    });
}


function updateDatabaseValue(db, tableName, column, value, id, content){ 
    $.ajax({
        data: 'dbname=' + db + '&tableName=' + tableName + "&column=" + column + "&value=" + value + "&id=" + id + "&content="+ content,
        url: '/cms/modifyTableValue.php',
        method: 'POST', //  or GET
        success: function(msg) {alert(msg);}
    });
}
function getDatabaseValue(db, tableName, column, value, id, completeFunction) { // SELECT column FROM db WHERE value = id 
    $.ajax({
        data: 'dbname=' + db + '&tableName=' + tableName + "&column=" + column + "&value=" + value + "&id=" + id,
        url: '/cms/getTableValue.php',
        method: 'POST', //  or GET
        success: function(msg) {completeFunction(msg);}
    });
}              
function fillEditingArea() {
    var pageName = $.cookie("editPageName");
    if (pageName != null) {
         getDatabaseValue("Pages", pageName, "Content", "id", "1", fillText);
    }
    else{
        window.location.href = "index.html";
    }
}
