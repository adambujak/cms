function updateDatabaseValue(db, tableName, column, value, id, content){ 
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
        getDatabaseValue("adambuja_Pages", pageName, "Title", "id", "1", fillText, document.getElementById('title'));
        getDatabaseValue("adambuja_Pages", pageName, "Head", "id", "1", fillText, document.getElementById('headTextArea'));
        getDatabaseValue("adambuja_Pages", pageName, "Content", "id", "1", fillText, document.getElementById('bodyTextArea'));
    }
    else{
        window.location.href = "index.html";
    }
}
function fillText(element, msg) {
    element.value = msg;
}

function saveClick() {
    updateDatabaseValue("adambuja_Pages", $.cookie("editPageName"), "Title", "id", "1", document.getElementById("title").value);
    updateDatabaseValue("adambuja_Pages", $.cookie("editPageName"), "Content", "id", "1", document.getElementById("bodyTextArea").value);
    updateDatabaseValue("adambuja_Pages", $.cookie("editPageName"), "Head", "id", "1", document.getElementById("headTextArea").value);
    window.location.href = "/pages.html";
}
function deletePage() {
    if (confirm("Are you Sure? You can't recover this!")) {
         $.ajax({
            data: 'tableName=' + $.cookie("editPageName"),
            url: '/cms/deletePage.php',
            method: 'POST', //  or GET
            success: function(msg) {alert(msg);window.location.href = "/pages.html";}
        });
    } 
}
