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

function getPageNames(dbName) {
    $.ajax({
        data: 'dbName=' + dbName,
        url: '/cms/getPageNames.php',
        method: 'POST', // or GET
        success: function(msg) {
            if (msg != "notlogged")
                fillBody(makePageButtons(msg));
            else {alert('You must be logged in to view this content!'); window.location.href = "/login";}
        }
    });
}

function fillBody(msg) { 
    document.getElementById('body').innerHTML = document.getElementById('body').innerHTML+msg;
}

function makePageButtons(msg) { //formats string with all page names in it into buttons - make it look nicer.
    var titles = msg.split('<br>');
    var ret = "";
    for (var i = 0; i < titles.length-1; i++) {
        ret += "<button onclick=\"editPage(\'"+titles[i]+"\')\">"+titles[i]+"</button>";
    }
    return ret;
}

