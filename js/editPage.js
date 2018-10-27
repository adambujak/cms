function updateDatabaseValue(db, tableName, column, value, id, content){
    content = encodeURIComponent('content');
    $.ajax({
        data: 'dbname=' + db + '&tableName=' + tableName + "&column=" + column + "&value=" + value + "&id=" + id + "&content="+ content,
        url: '/cms/modifyTableValue.php',
        method: 'POST', //  or GET
        success: function(msg) {alert(msg);}
    });
}
function getDatabaseValue(db, tableName, column, value, id, completeFunction, forElement) { // SELECT column FROM db WHERE value = id
    $.ajax({
        data: 'dbname=' + db + '&tableName=' + tableName + "&column=" + column + "&value=" + value + "&id=" + id,
        url: '/cms/getTableValue.php',
        method: 'POST', //  or GET
        success: function(msg) {completeFunction(forElement, msg);}
    });
}
function fillEditingArea() {
    var pageName = $.cookie("editPageName");
    if (pageName != null) {
        getDatabaseValue("pageDB", pageName, "Title", "id", "1", fillText, document.getElementById('title'));
        getDatabaseValue("pageDB", pageName, "Head", "id", "1", fillText, document.getElementById('headTextArea'));
        getDatabaseValue("pageDB", pageName, "Content", "id", "1", fillText, document.getElementById('bodyTextArea'));
    }
    else{
        window.location.href = "/home";
    }
}
function fillText(element, msg) {
    element.value = msg;
}

function saveClick() {
    updateDatabaseValue("pageDB", $.cookie("editPageName"), "Title", "id", "1", document.getElementById("title").value);
    updateDatabaseValue("pageDB", $.cookie("editPageName"), "Content", "id", "1", document.getElementById("bodyTextArea").value);
    updateDatabaseValue("pageDB", $.cookie("editPageName"), "Head", "id", "1", document.getElementById("headTextArea").value);
    window.location.href = "/pages.php";
}
function deletePage() {
    if (confirm("Are you Sure? You can't recover this!")) {
         $.ajax({
            data: 'tableName=' + $.cookie("editPageName"),
            url: '/cms/deletePage.php',
            method: 'POST', //  or GET
            success: function(msg) {alert(msg);window.location.href = "/pages.php";}
        });
    }
}
