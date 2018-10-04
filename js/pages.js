function getPageNames(dbName) {
    $.ajax({
        data: 'dbName=' + dbName,
        url: '/cms/getPageNames.php',
        method: 'POST', // or GET
        success: function(msg) {
            if (msg != "notlogged")
                fillBody(makePageButtons(msg), true);
            else {alert('You must be logged in to view this content!'); window.location.href = "/login";}
        }
    });
}
function fillBody(elementArray, prepend) { //prepend true if you want to prepend, otherwise, append
    var body = document.getElementsByTagName('body')[0];
    var lineBreak = document.createElement("BR");
    for (var i = 0; i < elementArray.length; i++) {
        if (prepend) {
            body.prepend(lineBreak)
            body.prepend(elementArray[i]);
        }
        else{
            body.append(lineBreak);
            body.appendChild(elementArray[i]);      
        }
    }
}
function makePageButtons(msg) { //formats string with all page names in it into buttons - TODO: make it look nicer.
    var titles = msg.split('<br>');
    var ret = new Array(titles.length-1);
    for (var i = 0; i < titles.length-1; i++) {
        var node = document.createElement("BUTTON");                 // Create a button
        var textnode = document.createTextNode(titles[i]);         // Create a text node
        node.appendChild(textnode);    
        node.addEventListener("click", function () {pageClick(node.innerHTML)});
        ret[i] = node;
    }
    return ret;
}
function pageClick(page) {
    $.cookie("editPageName", page);
    window.location.href = "editPage.html";
}
window.onload = function () {
    getPageNames("Pages");
    var modal = document.getElementById('newPageForm');
    var btn = document.getElementById("newPageButton");
    var span = document.getElementsByClassName("close")[0];
    btn.onclick = function() {
        modal.style.display = "block";
    }
    span.onclick = function() {
        modal.style.display = "none";
    }
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
}