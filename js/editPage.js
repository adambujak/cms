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
         getDatabaseValue("Pages", pageName, "Content", "id", "1", fillText, document.getElementById('bodyTextArea'));
    }
    else{
        window.location.href = "index.html";
    }
}
function fillText(element, msg) {
    element.value = msg;
}

function saveClick() {

    updateDatabaseValue("Pages", $.cookie("editPageName"), "Content", "id", "1", document.getElementById("bodyTextArea").value);
    //updateDatabaseValue("Pages", $.cookie("editPageName"), "Content", "id", "1", document.getElementById("editingArea").value);// -> Head
    window.location.href = "/pages.html";
}
