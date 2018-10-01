var modal, btn, span;

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
function fillBody(msg, prepend) { //prepend true if you want to prepend, otherwise, append
    if (prepend) 
        document.getElementById('body').innerHTML = msg + document.getElementById('body').innerHTML;
    else 
        document.getElementById('body').innerHTML = document.getElementById('body').innerHTML+msg;
}

function makePageButtons(msg) { //formats string with all page names in it into buttons - TODO: make it look nicer.
    var titles = msg.split('<br>');
    var ret = "";
    for (var i = 0; i < titles.length-1; i++) {
        ret += "<button onclick=\"editPage(\'"+titles[i]+"\')\">"+titles[i]+"</button>";
    }
    return ret;
}
window.onload = function () {
    getPageNames("Pages");
    setUpPopup();
}
function addPageClickHandler() {
    alert(modal.innerHTML);
     modal.style.display = "block";
    alert('asd');
}
function setUpPopup() {
    
    modal = document.getElementById('myModal');
    
    // Get the button that opens the modal
    btn = document.getElementById("myBtn");
  
    alert(document.getElementById("myBtn"));
    // Get the <span> element that closes the modal
    span = document.getElementsByClassName("close")[0];

    // When the user clicks on the button, open the modal
    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
}